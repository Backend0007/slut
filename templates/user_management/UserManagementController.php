<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserManagementController extends AbstractController
{
    #[Route('/user/management', name: 'app_user_management')]
    public function index(): Response
    {
        return $this->render('user_management/apps-users-management-list.twig', [
            'controller_name' => 'UserManagementController',
        ]);
    }
}
