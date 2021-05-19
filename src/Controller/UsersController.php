<?php

namespace App\Controller;

use App\Entity\Traduc;
use App\Form\TraducType;
use App\Form\EditProfilType;
use App\Form\EditPassType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig');
    }

    #[Route('/users/traduc/ajout', name: 'users_traduc_ajout')]
    public function ajoutArticle(Request $request)
    {
        $traduc = new Traduc;

        $form = $this->createForm(TraducType::class, $traduc);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $traduc->setUsers($this->getUser());
            $traduc->setActive(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($traduc);
            $em->flush();

            return $this->redirectToRoute('users');
        }

        return $this->render('users/Traduc/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
   }

   #[Route('/users/profil/modifier', name: 'users_profil_modifier')]
   public function editProfil(Request $request)
   {
       $user = $this->getUser();
       $form = $this->createForm(EditProfilType::class, $user);

       $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        
        $this->addFlash('massage', 'Profil mis à jour');
        return $this->redirectToRoute('users');
    }

    return $this->render('users/editprofil.html.twig', [
        'form' => $form->createView(),
    ]);
}
#[Route('/users/pass/modifier', name: 'users_pass_modifier')]
public function editPass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
{
    if($request->isMethod('POST')){
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        if($request->request->get('pass') == $request->request->get('pass2')){
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
            $em->flush();
            $this->addFlash('message', 'Mot de passse mis à jour avec succès');
             
            return $this->redirectToRoute('users');
        }else{
            $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
        }
    }

 return $this->render('users/editpass.html.twig');
}
}


