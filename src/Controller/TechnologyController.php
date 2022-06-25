<?php

namespace App\Controller;

use App\Entity\Technology;
use App\Repository\TechnologyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class TechnologyController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/technologies/', name: 'technologies_index')]
    public function index(TechnologyRepository $technologyRepository): Response
    {
        $technologiesCollection = $technologyRepository->findAll();
        $technologiesWithProjectsCounted = array();
        if (count($technologiesCollection) > 0) {
            foreach ($technologiesCollection as $tech) {
                $technologiesWithProjectsCounted[$tech->getId()] = $tech->countProjects();
            }
        }
       arsort($technologiesWithProjectsCounted);
        return new Response($this->twig->render('technology/index.html.twig', [
            'technologies' => $technologiesCollection,
            'techonologiesWithProjectsCounted' => $technologiesWithProjectsCounted,
        ]));

    }

    #[Route('/technologies/{slug}/', name: 'technologies_single')]
    public function single(Technology $technology, TechnologyRepository $technologyRepository): Response
    {
        $technologiesCollection = $technologyRepository->findAll();
        $technologiesWithProjectsCounted = array();
        if (count($technologiesCollection) > 0) {
            foreach ($technologiesCollection as $tech) {
                $technologiesWithProjectsCounted[$tech->getId()] = $tech->countProjects();
            }
        }

        return new Response($this->twig->render('technology/single.html.twig', [
            'technology' => $technology,
            'techonologiesWithProjectsCounted' => $technologiesWithProjectsCounted,
        ]));
    }

}
