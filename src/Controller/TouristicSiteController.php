<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TouristicSiteController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/site', name: 'app_touristic_site')]
    public function index(): Response
    {
        return $this->render('touristic_site/index.html.twig', [
            'controller_name' => 'TouristicSiteController',
        ]);
    }
}
