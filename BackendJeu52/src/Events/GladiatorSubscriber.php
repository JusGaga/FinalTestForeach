<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Gladiateur;
use App\Repository\GladiateurRepository;
use App\Repository\LudiRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class GladiatorSubscriber implements EventSubscriberInterface
{

    private $security;
    private $em;
    private $ludiRepository;
    private $gladRepository;

    public function __construct(Security $security, EntityManagerInterface $em, LudiRepository $ludiRepository, GladiateurRepository $gladRepository)
    {

        $this->security       = $security;
        $this->em             = $em;
        $this->ludiRepository = $ludiRepository;
        $this->gladRepository = $gladRepository;

    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ["createdGladiator", EventPriorities::PRE_WRITE]
        ];
    }

    public function createdGladiator(ViewEvent $event)
    {
        $gladiator = $event->getControllerResult();
        $method    = $event->getRequest()->getMethod();

        if ($gladiator instanceof Gladiateur && $method === "POST") {
            $user    = $this->security->getUser();
            $rest    = $user->getBourse() - 5;
            $getLudi = $gladiator->getLudi();
            $ludi    = $this->ludiRepository->findBy(["User" => $user->getId(), "Complet" => FALSE, "id" => $getLudi->getId()]);
            if ($rest >= 0) {
                if (count($ludi) !== 0) {
                    $nb_glad = count($this->gladRepository->findBy(["Ludi" => $ludi[0]->getId()]));


                    $adresse   = rand(0, 3);
                    $force     = rand(0, 3);
                    $equilibre = rand(0, 3);
                    $vitesse   = rand(0, 3);
                    $strat     = rand(0, 3);

                    $gladiator->setAdresse($adresse)
                        ->setStrenght($force)
                        ->setEquilibre($equilibre)
                        ->setVitesse($vitesse)
                        ->setStrat($strat)
                        ->setEntrainer(FALSE)
                    ;

                    if ($nb_glad === 9) {
                        $ludi[0]->setComplet(TRUE);
                        $this->em->persist($ludi[0]);
                        $this->em->flush();
                    }


                    $user->setBourse($rest);
                    $this->em->persist($user);
                    $this->em->flush();
                } else {
                    throw new \Exception("Vous n'avez plus de place dans votre ludi et vous n'avez plus de ludi disponible");
                }

            } else {
                throw new Exception("Vous n'avez pas assez d'argent");
            }
        }
    }


}
