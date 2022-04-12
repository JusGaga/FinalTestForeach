<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        $user           = $event->getUser();
        $data           = $event->getData();
        $data["nom"]    = $user->getNom();
        $data["prenom"] = $user->getPrenom();
        $data["id"]     = $user->getId();
        $data["bourse"] = $user->getBourse();

        $event->setData($data);
    }


}