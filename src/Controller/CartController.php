<?php

namespace App\Controller;

use App\class\cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class CartController extends AbstractController
{

    /**
     * @param cart $cart
     * @return Response
     */
    #[Route('/my_cart', name: 'cart')]
    public function index(cart $cart): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull()
        ]);
    }

    /**
     * @param cart $cart
     * @param $id
     * @return RedirectResponse
     */
    #[Route('/cart/add/{$id}', name: 'add_to_cart')]
    public function add(cart $cart, $id): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $cart->add($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/remove', name: 'remove_my_cart')]
    public function remove(cart $cart): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $cart->remove();
        return $this->redirectToRoute('site');
    }

    /**
     * @param cart $cart
     * @param $id
     * @return RedirectResponse
     */
    #[Route('/cart/delete/{$id}', name: 'delete_to_cart')]
    public function delete(cart $cart, $id): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }

    /**
     * @param cart $cart
     * @param $id
     * @return RedirectResponse
     */
    #[Route('/cart/decrase/{id}', name: 'decrase_to_cart')]
    public function decrease(cart $cart, $id): RedirectResponse
    {
        $cart->decrease($id);

        return $this->redirectToRoute('cart');
    }
}
