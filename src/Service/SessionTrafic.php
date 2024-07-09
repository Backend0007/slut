<?php 

namespace App\Service;

use DateTime;

use App\Entity\User;
use App\Entity\SessionOn;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Security\Core;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SessionTrafic extends ServiceEntityRepository
{

    private $entityManager;
    private $security;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager, Security $security)
    {
        parent::__construct($registry, SessionOn::class);
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function setSession()
    {
        $user = $this->security->getUser();
        if ($user instanceof User) {
            $sessionOn = new SessionOn();
            $time = new \DateTime();
            $timeCurrent = $time->format('d/m/Y');
           
            $hour = new \DateTime();
            $hourCurrent = $time->format('H:i:s');


            $sessionOn->setidUser($user->getIdUser());
            $sessionOn->setDateStarted($timeCurrent);
            $sessionOn->sethourStarted($hourCurrent);

            $this->entityManager->persist($sessionOn);
            $this->entityManager->flush();
        }
    }



public function countAllUserConnected(): int 
{
    $NumnerUsersConnected = $this->findAll();
    return count($NumnerUsersConnected);
} 



}


























?>