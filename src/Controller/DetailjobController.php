<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Demande;
use App\Form\PostuleType;
use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class DetailjobController extends AbstractController
{
    /**
     * @Route("/detailjob", name="app_detailjob")
     */
    public function index(): Response
    {
        return $this->render('detailjob/index.html.twig', [
            'controller_name' => 'DetailjobController',
        ]);
    }
    /**
    * @Route("/ann/{id}", name="app_detailjob")
    */
    public function detail($id,Request $request, SluggerInterface $slugger): Response
    {
       $annonce =$this->getDoctrine()->getRepository(Annonce::class)->find($id);



       $postule = new Demande();    
       $form = $this->createForm(PostuleType::class,$postule);
       
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {   
           $postule = $form->getData();
           $brochureFile = $form->get('brochure')->getData();
        // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $postule->setBrochureFilename($newFilename);
            }
           $em = $this->getDoctrine()->getManager();
           $em->persist($postule);
           $em->flush();


           
           return $this->redirectToRoute('app_annonce_index');

           }


       return $this->render('detailjob/index.html.twig', ["ann" => $annonce ,"monform" => $form->createView()]);
    }
    }