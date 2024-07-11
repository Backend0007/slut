<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommercialController extends AbstractController
{
    #[Route('/commercial', name: 'app_commercial')]
    public function index(): Response
    {
        return $this->render('commercial/index.html.twig', [
            'controller_name' => 'CommercialController',
        ]);
    }
  
  
  
    #[Route('/commercial', name: 'app-create-partener')]
    public function index2(): Response
    {
        return $this->render('commercial/index.html.twig', [
            'controller_name' => 'CommercialController',
        ]);
    }
}
