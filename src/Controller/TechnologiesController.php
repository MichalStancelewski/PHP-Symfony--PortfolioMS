<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechnologiesController extends AbstractController
{
    #[Route('/technologies', name: 'technologies')]
    public function index(): Response
    {
        return $this->render('technologies/index.html.twig', [
            'controller_name' => 'TechnologiesController',
        ]);
    }
}
