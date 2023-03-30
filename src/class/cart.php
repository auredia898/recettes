<?php

namespace App\class;

use App\Entity\TouristicSite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 *
 */
class cart
{
    private $session;
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Session $session
     */
    public function __construct(EntityManagerInterface $entityManager, Session $session)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $id
     * @return void
     */
    public function add($id): void
    {
        $warning = null;
        $cart = $this->session->get('cart', []);
        if (!empty($cart[$id])) {
            $warning = 'Le site est déjà dans le panier de reservation';
        } else {
            $cart[$id] = 1;
        }
        $this->session->set('cart', $cart);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->session->get('cart');
    }


    /**
     * @return mixed
     */
    public function remove(): mixed
    {
        return $this->session->remove('cart');
    }

    /**
     * @param $id
     * @return null
     */
    public function delete($id){

        $cart = $this->session->get('cart', []);
        unset($cart[$id]);

        return $this->session->set('cart', $cart);
    }

    /**
     * @param $id
     * @return null
     */
    public function decrease($id)
    {
        $cart = $this->session->get('cart', []);

        if($cart[$id] >1 ){
            $cart[$id]--;
        }
        else{
            unset($cart[$id]);

        }

        return $this->session->set('cart', $cart);
    }

    /**
     * @return array
     */
    public function getFull(): array
    {

        $cartComplete = [];

        if ($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                $product_object =  $this->entityManager->getRepository(TouristicSite::class)->findOneById($id);

                if(!$product_object)
                {
                    $this->delete($id);
                    continue;
                }
                $cartComplete[] = [
                    'product' => $product_object,
                    'quantity' => $quantity,
                ];
            }
        }
        return $cartComplete;
    }


}
