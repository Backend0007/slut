<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;
use App\Service\SetNewUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class FormController extends AbstractController
{
    #[Route('/form', name: 'app_register')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $message_red = '';
        $message_green = '';
        return $this->render('form/forms-validation.html.twig', [
            'message_red' => $message_red,
            'message_green' => $message_green,
        ]);
    }






    #[Route('/nouveau_utilisateur', name: 'app_register_new')]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, SetNewUserService $setNewUserservice): Response
    {
        $notification = $setNewUserservice->_setNewUserServ($request);
        
       
        return $this->render('form/forms-validation.html.twig', [
            'message_return' => $notification,
            
        ]);
    }

    #[Route('/nouveau_utilisateur_management', name: 'app_register_new_from_management')]
    #[IsGranted('ROLE_USER')]
    public function newFromManagement(Request $request, SetNewUserService $setNewUserservice): Response
    {
        $notification = $setNewUserservice->_setNewUserServ($request);
        
       
        return $this->redirectToRoute('app_user_management', [
            'message_return' => $notification,
            'hidden' => true,
            'show' => true,
            'lock' => true,
        ]);
    
    }



}
