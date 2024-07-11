<?php
namespace App\Repository;

use App\Entity\User;
use App\Entity\SessionOn;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


class GetUserManagementRepository extends ServiceEntityRepository
{
    private SessionOn $sessionOn;
    private UserRepository $userRepository;

    public function __construct(ManagerRegistry $registry, UserRepository $userRepository)
    {

        parent::__construct($registry, User::class);
        $this->userRepository = $userRepository;
        
    }



 public function _getUserManagementFromRepository(): array
{
   $UserGeted = $this->userRepository->findAll();
   return $UserGeted;
}


public function _getUserManagementFromRepositoryById(string $idRepository): array
{
   $UserGetedUniq = $this->userRepository->findBy(['idUser' => $idRepository]);
   return $UserGetedUniq;
}
}


