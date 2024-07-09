<?php
namespace App\Repository;

use App\Entity\User;
use App\Entity\SessionOn;
use App\Repository\UserRepository;
use App\Repository\SessionOnRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


class GetSessionConnectedRepository extends ServiceEntityRepository
{
    private SessionOn $sessionOn;
    private UserRepository $userRepository;
    private SessionOnRepository $sessionOnRepository;

    public function __construct(UserRepository $userRepository, SessionOnRepository $sessionOnRepository, ManagerRegistry $registry)
    {

        parent::__construct($registry, SessionOn::class);
        $this->userRepository = $userRepository;
        $this->sessionOnRepository = $sessionOnRepository;
        
    }



 public function _getSessionConnectedFromRepository(): array
{
   $SessionAvailable = $this->sessionOnRepository->findAll();
   return $SessionAvailable;
}
}


