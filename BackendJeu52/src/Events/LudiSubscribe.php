<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Ludi;
use App\Repository\LudiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class LudiSubscribe implements EventSubscriberInterface
{

    private $security;
    private $repository;
    private $em;

    private $char;
    private $lutte;
    private $atlh;

    public function __construct(Security $security, LudiRepository $repository, EntityManagerInterface $em)
    {
        $this->security   = $security;
        $this->repository = $repository;
        $this->em         = $em;
        $this->atlh       = "athletisme";
        $this->char       = "course de char";
        $this->lutte      = "lutte";
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ["createLudi", EventPriorities::PRE_WRITE]
        ];
    }

    public function createLudi(ViewEvent $event)
    {
        $ludi   = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();


        if ($ludi instanceof Ludi && $method === "POST") {
            $user = $this->security->getUser();
            if (!empty($this->repository->findBy(['User' => $user->getId()]))) {
                $rest = $user->getBourse() - 60;
            }

            if ($rest >= 0) {


                $ludi->setComplet(FALSE);

                if ($ludi->getSpe() === "1") {
                    $ludi->setSpe($this->char);
                } else if ($ludi->getSpe() === "2") {
                    $ludi->setSpe($this->lutte);
                } else if ($ludi->getSpe() === "3") {
                    $ludi->setSpe($this->atlh);
                }

                $ludi->setUser($user);
                $user->setBourse($rest);
                $this->em->persist($user);
                $this->em->flush();
            } else {
                throw new \Exception("Vous n'avez pas assez d'argent");
            }
        }
    }


}

