<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListejobsController extends AbstractController
{
    /**
     * @Route("/listejobs", name="app_listejobs")
     */
    public function index(): Response
    {
        return $this->render('listejobs/index.html.twig', [
            'controller_name' => 'ListejobsController',
        ]);
    }


 

    }



