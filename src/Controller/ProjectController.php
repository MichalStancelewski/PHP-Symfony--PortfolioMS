<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ProjectController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, ProjectRepository $projectRepository): Response
    {
        return new Response($twig->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]));
    }
}
