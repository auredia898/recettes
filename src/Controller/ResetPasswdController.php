<?php

namespace App\Controller;

use App\Class\Mail;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ResetPassword;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ResetPasswdController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/forgot_password", name: 'reset_password')]
    public function index(Request $request)
    {
        if($this->getUser())
        {
            return $this->redirectToRoute('home');
        }

        if ($request->get('email')) {

            $client = $this->entityManager->getRepository(Client::class)->findOneByEmail($request->get('email'));

            if ($client) {
                $reset_password = new ResetPassword();
                $reset_password ->setUser($client);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new \DateTime());
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                $url = $this->generateUrl('update_password', [
                    'token' => $reset_password->getToken()
                ]);
                $content= "Bonjour".$client->getFirstname()."<br/>Vous avez demandé a réinitialiser votre mot de passe sur la Boutique Store.<br/><br/>";
                $content ="Merci de bien vouloir <a href".$url.">cliquer ici</a> pour mettre à jour votre mot de passe";
                $mail = new mail();
                $mail->send($client->getEmail(), $client->getFirstname().' '.$client->getLastname(), 'Réinitialiser votre mot de passe sur Store', $content);
                $this->addFlash('notice', 'Veuillez consulter votre email.');
            }
            else{
                $this->addFlash('notice', 'Adresse email inconnue');
            }
        }
        return $this->render('reset_password/index.html.twig');
    }

    #[Route("/change_password/{token}", name: 'update_password')]
    public function update(Request $request, $token, UserPasswordEncoder $encoder)
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);

        if (!$reset_password) {
            return $this->redirectToRoute('reset_password');
        }
        $now = new DateTime();
        if ($now > $reset_password->getCreatedAt()->modify('+1hour')) {
            $this->addFlash('notice', 'Votre demande a expiré');
            return $this->redirectToRoute('reset_password');
        }

        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $new_pwd = $form->get('new_password')->getData();
            $password = $encoder->encodePassword($reset_password->getUser(), $new_pwd);
            $reset_password->getUser()->setPassword($password);
            $this->entityManager->flush();
            $this->addFlash('notice','Votre mot de passe a bien été mise à jour');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/update.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
