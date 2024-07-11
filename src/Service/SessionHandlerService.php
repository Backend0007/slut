<?php
namespace App\Service;

use App\Repository\SessionHandlerRepository;

class SessionHandlerService
{

private SessionHandlerRepository $sessionHandler;

public function __construct(SessionHandlerRepository $sessionHandler)
{
    $this->sessionHandler = $sessionHandler;
}


public function _sessionHandlerService(string $id): bool
{
    $result = $this->sessionHandler->_SessionHandlerRepository($id);
    return $result;
}




}