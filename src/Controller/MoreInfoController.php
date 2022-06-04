<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoreInfoController extends AbstractController
{
    #[Route('/more-info/', name: 'more_info')]
    public function index(): Response
    {
        return $this->render('more_info/index.html.twig', [
            'controller_name' => 'MoreInfoController',
        ]);
    }
}
