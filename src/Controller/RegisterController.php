<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this ->entityManager = $entityManager;
    }

    #[Route('/register', name: 'register')]
    public function index(Request $request,UserPasswordHasherInterface $hasher ): Response
    {
        //initialization of variables
        $notification = null;
        $client = new Client();
        $form = $this->createForm(RegisterFormType::class, $client);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $search_mail = $this->entityManager->getRepository(Client::class)->findOneByEmail($client->getEmail());

            //check if the email already exists in the database
            if (!$search_mail) {
                $password = $hasher->hashPassword($client, $client->getpassword());
                $client->setpassword($password);

                $this->entityManager->persist($client);
                $this->entityManager->flush();
                $notification = 'sucess';

            } else {
                $notification = "error";
            }
            //redirect user in home page after registration
            return $this->redirectToRoute('home');
        }
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'form' => $form->createView(),
            'notification' => $notification,
        ]);
    }

}
