<?php
namespace App\Service;

use App\Entity\User;
use App\Entity\SessionOn;
use App\Service\FormatDate;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\GetUserManagementRepository;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;


class GetUserManagementService
{
    
    private SessionOn $sessionOn;
    private Security $security;
    private GetUserManagementRepository $getUserManagementRepository;
    private FormatDate $formatDate;

    public function __construct(Security $security, GetUserManagementRepository $getUserManagementRepository, FormatDate $formatDate)
   {
       
        $this->security = $security;
        $this->getUserManagementRepository = $getUserManagementRepository;
        $this->formatDate = $formatDate;
        
    }



 public function _getUserManagementFromService(): array
{

    
    $userGeted = $this->getUserManagementRepository->_getUserManagementFromRepository();
    $UserWithDate = []; 
    
    foreach ($userGeted as $user) {
        $formattedDate = $this->formatDate->formatDateInFrench($date = new \DateTime($user->getDateOfInscription()));
    
       
        $UserWithDate[] = [
            'user' => $user, 
            'dateOfInscription' => $formattedDate 
        ];
    }


    return $UserWithDate;
}



public function _getUserManagementFromServiceById(string $idService): array
{

    
    $userGetedUniq = $this->getUserManagementRepository->_getUserManagementFromRepositoryById($idService);
    $UserWithDateUniq = []; 
    
    foreach ($userGetedUniq as $user) {
        $formattedDate = $this->formatDate->formatDateInFrench($date = new \DateTime($user->getDateOfInscription()));
    
       
        $UserWithDateUniq[] = [
            'user' => $user, 
            'dateOfInscription' => $formattedDate 
        ];
    }


    return $UserWithDateUniq;
}


}