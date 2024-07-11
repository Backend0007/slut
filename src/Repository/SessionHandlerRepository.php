<?php 

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SessionHandlerRepository extends ServiceEntityRepository
{
   private SessionOnRepository $sessionOnRepository;


    public function __construct(SessionOnRepository $sessionOnRepository)
    {
    $this->sessionOnRepository = $sessionOnRepository;

    }


     public function _SessionHandlerRepository(string $id): string
     {

     
       $is_exist = $this->sessionOnRepository->findOneBy(['idUser' => $id]);
       
     
        if ($is_exist != null) {
           $result = true;
            
        } else {
              $result = false;
        }
        return $result;
     }


}