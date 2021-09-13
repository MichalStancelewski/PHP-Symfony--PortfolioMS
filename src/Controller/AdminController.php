<?php

namespace App\Controller;

use App\Entity\Projects;
use App\Entity\Technologies;
use App\Form\ProjectType;
use App\Form\TechnologiesType;
use App\Repository\TechnologiesRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin.')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TechnologiesRepository $technologiesRepository): Response
    {
        $technologies = $technologiesRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'technologies' => $technologies
        ]);
    }

    #[Route('/create-project', name: 'create_project')]
    public function createProject(Request $request, FileUploader $fileUploader): Response
    {
        $project = new Projects();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $file */
            $file = $request->files->get('projects')['image'];
            if ($file) {
                $filename = $fileUploader->uploadFile($file);
                $project->setImage($filename);
            }
            $em->persist($project);
            $em->flush();
            $this->addFlash('success', 'Project created');
            return $this->redirect($this->generateUrl('admin.index'));
        }
        return $this->render('admin/createProject.html.twig', [
            'formCreateProject' => $form->createView()
        ]);
    }

    #[Route('/create-technology', name: 'create_technology')]
    public function createTechnology(Request $request, FileUploader $fileUploader): Response
    {
        $technology = new Technologies();

        $form = $this->createForm(TechnologiesType::class, $technology);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $file */
            $file = $request->files->get('technologies')['image'];
            if ($file) {
                $filename = $fileUploader->uploadFile($file);
                $technology->setImage($filename);
            }
            $em->persist($technology);
            $em->flush();
            $this->addFlash('success', 'Technology created');
            return $this->redirect($this->generateUrl('admin.index'));
        }
        return $this->render('admin/createTechnology.html.twig', [
            'formCreateTechnology' => $form->createView()
        ]);
    }


}



