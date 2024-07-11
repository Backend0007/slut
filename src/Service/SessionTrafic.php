<?php 

namespace App\Service;

use DateTime;

use App\Entity\User;
use App\Entity\SessionOn;
use App\Repository\SessionOnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SessionTrafic extends ServiceEntityRepository
{

    private EntityManagerInterface $entityManager;
    private Security $security;
    private SessionOnRepository $userRepository;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager, Security $security, SessionOnRepository $sessionOnRepository)
    {
        parent::__construct($registry, SessionOn::class);
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->userRepository = $sessionOnRepository;
    }

    public function setSession()
    {
        $user = $this->security->getUser();
        if ($user instanceof User) {
            $sessionOn = new SessionOn();
            $time = new \DateTime();
            $timeCurrent = $time->format('d/m/Y');
            $hourCurrent = $time->format('H:i:s');

            $is_Already = $this->userRepository->findOneby(['idUser' => $user->getIdUser()]);
            if ($is_Already != null) {

                
            } else {
                $sessionOn = new SessionOn();

                $sessionOn->setidUser($user->getIdUser());
                $sessionOn->setDateStarted($timeCurrent);
                $sessionOn->sethourStarted($hourCurrent);
    
                $this->entityManager->persist($sessionOn);
                $this->entityManager->flush();
            }

                
        }
    }



public function countAllUserConnected(): int 
{
    $NumnerUsersConnected = $this->findAll();
    return count($NumnerUsersConnected);
} 



}


























?>