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
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/', name: 'homepage')]
    public function index(ProjectRepository $projectRepository, TechnologyRepository $technologyRepository): Response
    {
        return new Response($this->twig->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'technologies' => $technologyRepository->findAll(),
        ]));
    }

    #[Route('/project/{slug}/', name: 'project')]
    public function single(Project $project, TechnologyRepository $technologyRepository): Response
    {
        return new Response($this->twig->render('project/single.html.twig', [
            'project' => $project,
        ]));
    }

}
