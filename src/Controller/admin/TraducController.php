<?php

namespace App\Controller\admin;

use App\Repository\TraducRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

  /** 
    * @Route("/admin/Traduc", name= "admin_Traduc_")
    * @package App\Controller\admin
    */
class TraducController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(TraducRepository $traducRepo): Response
    {
        return $this->render('admin/traduc/index.html.twig', [
            'traduc' => $traducRepo->findAll()
        ]);
    }

    #[Route('/activer/{id}', name: 'activer')]
    public function activer(Traduc $traduc): Response
    {
       $traduct->setActive(($traduct->getActive())?false:true);

       $em = $this->getDoctrine()->getManager();
       $em->persist($traduct);
       $em->flush();
       
       return new Response("true");
    }
}
