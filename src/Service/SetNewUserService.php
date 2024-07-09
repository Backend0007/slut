<?php 

namespace App\Service;

use DateTime;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;
use App\Repository\SetNewUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class SetNewUserService 
{
    private SetNewUserRepository $setNewUserRepository;

    public function __construct(SetNewUserRepository $setNewUserRepository)
    {
      $this->setNewUserRepository = $setNewUserRepository;
    }

    public function _setNewUserServ(Request $request): string
    {
      $notification = $this->setNewUserRepository->_setNewUserRepo($request);
    

       return $notification;
    }
}


























?>