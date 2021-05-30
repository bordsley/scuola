<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticationFailureListener 
{
    /**
     * @param AuthenticationFailureEvent $event
     */
    public function onJWTNotFound(AuthenticationFailureEvent $event)
    {
    
        $event->setResponse(new RedirectResponse("/login"));
    }

}

