<?php

namespace App\Controller;
use App\Form\PostuleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Demande;

class PostulerController extends AbstractController
{
    /**
     * @Route("/postuler", name="app_postuler")
     */
    public function index(): Response
    {
        return $this->render('postuler/index.html.twig', [
            'controller_name' => 'PostulerController',
        ]);
    }

     /**
     * @Route("/ajouter", name="app_postuler")
     */
    public function ajout(Request $request, SluggerInterface $slugger): Response
    {
        
        $postule = new Demande();    
        $form = $this->createForm(PostuleType::class,$postule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
         
            
            $postule = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($postule);
            $em->flush();
            return $this->redirectToRoute('app_annonce_index');

            }

            
          
             
    
        
        

        return $this->renderForm('postuler/index.html.twig',["monform" => $form->createView()]);
    }




    }






