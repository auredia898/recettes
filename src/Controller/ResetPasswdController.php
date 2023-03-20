<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswdController extends AbstractController
{
    #[Route('/reset/passwd', name: 'app_reset_passwd')]
    public function index(): Response
    {
        return $this->render('reset_passwd/index.html.twig', [
            'controller_name' => 'ResetPasswdController',
        ]);
    }
}
