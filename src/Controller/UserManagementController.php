<?php

namespace App\Controller;


use App\Service\RestrictedService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\GetUserManagementService as ServiceGetUserManagementService;

class UserManagementController extends AbstractController
{
    #[Route('/user_management', name: 'app_user_management')]
    public function index(Request $request, ServiceGetUserManagementService $getManagementConnectedService, RestrictedService $restricted): Response
    {
        if($restricted->restricted() === true) {
            return $this->redirectToRoute('app_logout');
        };



   
        $messageReturn = "";
        $hidden = "hidden";
        $show = "show";
        $lock = "";
   

         $userManagement = $getManagementConnectedService->_getUserManagementFromService();

         if ($request->query->get('message_return') != ""){
         $messageReturn = $request->query->get('message_return');
        }

        if ($request->query->get('hidden') == true){
            $hidden = "";
           }

           if ($request->query->get('show') == true){
            $show = "";
           }
         
           if ($request->query->get('show') == true){
            $lock = "fondu-form-back";
           }
        return $this->render('user_management/apps-users-Management-list.html.twig', [
            'controller_name' => 'UserManagementController',
            'user_management' => $userManagement,
            'message_return' => $messageReturn,
            'hidden' => $hidden,
            'show' => $show,
            'lock' => $lock,

        ]);
    }
    
    







    #[Route('/user_management_profil', name: 'app_user_management_profil')]
    public function indexUserAccount(Request $request, ServiceGetUserManagementService $getManagementConnectedService, RestrictedService $restricted): Response
    {
        if($restricted->restricted() === true) {
            return $this->redirectToRoute('app_logout');
        };
        


        

         $userSelected = $getManagementConnectedService->_getUserManagementFromServiceById($request->request->get('id'));

 

        return $this->render('user_management/pages-user-account-settings.html.twig', [
            'controller_name' => 'UserManagementController',
            'user_management_profil' => $userSelected,
   
        ]);
    }
}
