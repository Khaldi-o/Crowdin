<?php

namespace App\Controller\admin;

use App\Entity\Projects;
use App\Form\ProjectsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
    * @Route("/admin", name= "admin_")
    * @package App\Controller\admin
    */

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/projects/ajout', name: 'projects_ajout')]
    public function ajoutProject(Request $request)
    {
        $project = new Projects;

        $form = $this->createform(ProjectsType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/projects/ajout.html.twig', [
            'form' => $form->createView()
        ]);
}
}

