<?php
namespace App\Service;

use App\Entity\User;
use App\Entity\SessionOn;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\GetUserConnectedRepository;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;


class GetUserConnectedService
{
    
    private SessionOn $sessionOn;
    private Security $security;
    private GetUserConnectedRepository $getUserConnectedRepository;

    public function __construct(Security $security, GetUserConnectedRepository $getUserConnectedRepository)
   {
       
        $this->security = $security;
        $this->getUserConnectedRepository = $getUserConnectedRepository;
        
    }



 public function _getUserConnectedFromService(): array
{
  $sessionRescue = $this->getUserConnectedRepository->_getUserConnectedFromRepository();
    return $sessionRescue;
}



}