<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core;
use App\Repository\SessionOnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
     private EntityManagerInterface $entityManager;
     private UserRepository $userRepository;
     private SessionOnRepository $sessionRepository;
     private Security $security;

     public function __construct(Security $security, EntityManagerInterface $entityManager, SessionOnRepository $sessionOnRepository)
     {
         $this->security = $security;
         $this->entityManager = $entityManager;
         $this->sessionRepository = $sessionOnRepository;
     }



    #[Route(path: '/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/auth-login-modern.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }















    #[Route(path: '/RemoveSession', name: 'app_removeSession')]
    public function removeSession()
    {
          $user = $this->security->getUser();
          if($user instanceof User){
            $idUser = $user->getIdUser();
            $sessionOn = $this->sessionRepository->findOneBy(['idUser' => $idUser]);
            $this->entityManager->remove($sessionOn);
            $this->entityManager->flush();

          }

          return $this->redirectToRoute('app_logout');
    }






    
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
