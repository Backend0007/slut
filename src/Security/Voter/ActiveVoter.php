<?php
namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\SessionOn;
use Symfony\Component\Security\Core;
use App\Service\SessionHandlerService;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\SessionHandlerRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ActiveVoter extends Voter
{
    const LOGOUT = 'ACTIVE';
    const REST = 'DESACTIVE';

    private $security;
    private SessionHandlerService $sessionHandler;

    public function __construct(Security $security, SessionHandlerService $sessionHandler)
    {
        $this->security = $security;
        $this->sessionHandler = $sessionHandler;
    }

    protected function supports(string $attribute,mixed $subject): bool
    {
        if (!in_array($attribute, [self::LOGOUT, self::REST])) {
            return false;
        }

        if (!$subject instanceof SessionOn) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::LOGOUT:
                return $this->logout();
           
        }

        return false;
    }

    private function logout(): bool
    {
        $id = $this->security->getUser()->getIdUser();       
        
        return $this->sessionHandler->_sessionHandlerService($id);
        
      
 
    }

   
}
