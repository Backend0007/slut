<?php
namespace App\Service;

use SessionHandler;
use App\Service\SessionHandlerService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class RestrictedService
{
    private $authChecker;
    private $urlGenerator;
    private $sessionHandlerService;
    private $security;

    public function __construct(AuthorizationCheckerInterface $authChecker, UrlGeneratorInterface $urlGenerator, SessionHandlerService $sessionHandlerService, Security $security)
    {
        $this->authChecker = $authChecker;
        $this->urlGenerator = $urlGenerator;
        $this->sessionHandlerService = $sessionHandlerService;
        $this->security = $security;
    }

    public function restricted():bool
    {
       
         $id = $this->security->getUser()->getIdUser();
        $this->sessionHandlerService->_sessionHandlerService($id);
       
        if ($this->sessionHandlerService->_sessionHandlerService($id) != true) {

                return true;
        } else {
            return false;
        }
        
    }
}