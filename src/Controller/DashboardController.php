<?php

namespace App\Controller;


use App\Service\SessionTrafic;
use App\Service\RestrictedService;
use App\Service\GetUserConnectedService   ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    
    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('ROLE_MANAGER')]
    public function index(SessionTrafic $sessionTrafic, GetUserConnectedService $getUserConnectedService, RestrictedService $restricted): Response
    { 
        if($restricted->restricted() === true) {
            return $this->redirectToRoute('app_logout');
        };
      
        




         $numberUserConnected = $sessionTrafic->countAllUserConnected();
         $sessionActive = $getUserConnectedService->_getUserConnectedFromService();

        $affluence = 20;

        return $this->render('dashboard/dashboards-analytics.html.twig', [
            'controller_name' => 'DashboardController',
            'numberUserConnected' => $numberUserConnected,
            'getSessionActive' => $sessionActive,
            'affluence' => $affluence,
        ]);
    }






    #[Route('/dashboard_user', name: 'app_dashboard_user')]
    #[IsGranted('ROLE_USER')]
    public function index2(RestrictedService $restricted): Response
    {
        if($restricted->restricted() === true) {
            return $this->redirectToRoute('app_logout');
        };


        
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }





    #[Route('/dashboard_hr', name: 'app_dashboard_hr')]
    #[IsGranted('ROLE_MANAGER')]
    public function index3(RestrictedService $restricted): Response
    {
        if($restricted->restricted() === true) {
            return $this->redirectToRoute('app_logout');
        };





        return $this->render('dashboard/dashboards-hr.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }




    
    #[Route('/dashboard_social', name: 'app_dashboard_social')]
    #[IsGranted('ROLE_USER')]
    public function index4(RestrictedService $restricted): Response
    {
        if($restricted->restricted() === true) {
            return $this->redirectToRoute('app_logout');
        };





        return $this->render('dashboard/dashboards-social-media.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }
}
