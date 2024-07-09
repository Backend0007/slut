<?php
namespace App\Repository;

use App\Entity\User;
use App\Entity\SessionOn;
use App\Repository\UserRepository;
use App\Repository\SessionOnRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\GetSessionConnectedRepository;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


class GetUserConnectedRepository extends ServiceEntityRepository
{
    
    private SessionOn $sessionOn;
    private UserRepository $userRepository;
    private SessionOnRepository $sessionOnRepository;
    private GetSessionConnectedRepository $getSessionConnected;

    public function __construct(UserRepository $userRepository, SessionOnRepository $sessionOnRepository, ManagerRegistry $registry, GetSessionConnectedRepository $getSessionConnected)
    {

        parent::__construct($registry, User::class);
        $this->userRepository = $userRepository;
        $this->sessionOnRepository = $sessionOnRepository;
        $this->getSessionConnected = $getSessionConnected;
        
    }


    public function _getUserConnectedFromRepository(): array
    {
        $getSessionConnected = $this->getSessionConnected->_getSessionConnectedFromRepository();
    
        if (!empty($getSessionConnected)) {
            $userIds = [];
    
            foreach ($getSessionConnected as $session) {
                $userIds[] = $session->getIdUser();
            }
        }
    
        $sessions = $this->sessionOnRepository->findAll();
        $users = $this->userRepository->findBy(['idUser' => $userIds]);
    
     
        $sessionsByUser = [];
        foreach ($sessions as $session) {
            $sessionsByUser[$session->getIdUser()][] = $session;
        }
    

        $userInfos = [];
        foreach ($users as $user) {
            $userId = $user->getIdUser();
            $userInfos[] = [
                'user' => $user,
                'sessions' => $sessionsByUser[$userId] ?? [],
            ];
        }
    
        return [
            'userInfo' => $userInfos,
        ];
    }

}


