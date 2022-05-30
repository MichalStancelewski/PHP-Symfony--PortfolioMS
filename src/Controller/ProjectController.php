<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\TechnologyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ProjectController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, ProjectRepository $projectRepository, TechnologyRepository $technologyRepository): Response
    {
        return new Response($twig->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'technologies' => $technologyRepository->findAll(),
        ]));
    }

    #[Route('/project/{id}', name: 'project')]
    public function single(Environment $twig, Project $project, TechnologyRepository $technologyRepository): Response
    {
        return new Response($twig->render('project/single.html.twig', [
            'project' => $project,
        ]));
    }

}
