<?php

namespace App\Controller\admin;


use App\Entity\Projects;
use App\Form\ProjectsType;
use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

   /** 
    * @Route("/admin/projects", name= "admin_projects_")
    * @package App\Controller\admin
    */
class ProjectsController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjectsRepository $catsRepo): Response
    {
        return $this->render('admin/projects/index.html.twig', [
            'Projects' => $catsRepo->findAll()
        ]);
    }

    #[Route('/ajout', name: 'ajout')]
    public function ajoutProject(Request $request)
    {
        $Project = new Projects;

        $form = $this->createform(ProjectsType::class, $Project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($Project);
            $em->flush();

            return $this->redirectToRoute('admin_projects_home');
        }

        return $this->render('admin/projects/ajout.html.twig', [
            'form' => $form->createView()
        ]);
}
 #[Route('/modifier/{id}', name: 'modifier')]
 public function ModifierProject(Projects $project, Request $request)
 {

     $form = $this->createform(ProjectsType::class, $project);

     $form->handleRequest($request);

     if($form->isSubmitted() && $form->isValid()){
         $em = $this->getDoctrine()->getManager();
         $em->persist($project);
         $em->flush();

         return $this->redirectToRoute('admin_Projects_home');
     }

     return $this->render('admin/projects/ajout.html.twig', [
         'form' => $form->createView()
     ]);
}
}
