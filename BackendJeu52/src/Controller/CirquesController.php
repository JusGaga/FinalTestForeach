<?php

namespace App\Controller;

use App\Repository\GladiateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CirquesController extends AbstractController
{
    /**
     * @Route("/api/cirque",name="Cirque",methods={"GET"})
     */
    public
    function Cirque(GladiateurRepository $gladiateurRepository, EntityManagerInterface $em
    )
    {
        $AllGlad       = $gladiateurRepository->findAll();
        $jeuSelect     = rand(1, 3);
        $BestGladScore = 0;
        $BestGladId    = 0;
//        Course de char
        if ($jeuSelect === 1) {
            foreach ($AllGlad as $a) {
                $score = 0.8 * $a->getAdresse() + $a->getEquilibre() + 0.3 * $a->getStrenght() + 0.1 * $a->getVitesse() + rand(0, 10)/10;
                if ($score > $BestGladScore) {
                    $BestGladScore = $score;
                    $BestGladId    = $a->getId();
                }
            }
            $b = $gladiateurRepository->find($BestGladId);

            $b->setEquilibre($b->getEquilibre() + 1 >= 10 ? 10 : $b->getEquilibre() + 1);

            $b->getLudi()->getUser()->setBourse($b->getLudi()->getUser()->getBourse() + 2);

            $em->persist($b);
            $em->flush();
            return $this->json($b, 200, [], ['groups' => "glad_read"]);
//            Lutte
        } else if ($jeuSelect === 2) {
            foreach ($AllGlad as $a) {
                $score = 0.3 * $a->getAdresse() + 0.1 * $a->getEquilibre() + 0.8 * $a->getStrenght() + 0.4 * $a->getVitesse() + rand(0, 10)/10;
                if ($score > $BestGladScore) {
                    $BestGladScore = $score;
                    $BestGladId    = $a->getId();
                }
            }
            $b = $gladiateurRepository->find($BestGladId);
            $b->setStrenght($b->getStrenght() + 1 >= 10 ? 10 : $b->getStrenght() + 1);
            $b->getLudi()->getUser()->setBourse($b->getLudi()->getUser()->getBourse() + 2);

            $em->persist($b);
            $em->flush();
            return $this->json($b, 200, [], ['groups' => "glad_read"]);
//            Atlhétisme
        } else if ($jeuSelect === 3) {
            foreach ($AllGlad as $a) {
                $score = 0.4 * $a->getAdresse() + 0.4 * $a->getEquilibre() + 0.4 * $a->getStrenght() + 0.4 * $a->getVitesse() + rand(0, 1);
                if ($score > $BestGladScore) {
                    $BestGladScore = $score;
                    $BestGladId    = $a->getId();
                }
            }
            $b = $gladiateurRepository->find($BestGladId);
            $b->setStrenght($b->getStrenght() + 0.2 >= 10 ? 10 : $b->getStrenght() + 0.2)
                ->setEquilibre($b->getEquilibre() + 0.2 >= 10 ? 10 : $b->getEquilibre() + 0.2)
                ->setStrat($b->getStrat() + 0.2 >= 10 ? 10 : $b->getStrat() + 0.2)
                ->setVitesse($b->getVitesse() + 0.2 >= 10 ? 10 : $b->getVitesse() + 0.2)
                ->setAdresse($b->getAdresse() + 0.2 >= 10 ? 10 : $b->getAdresse() + 0.2)
            ;

            $b->getLudi()->getUser()->setBourse($b->getLudi()->getUser()->getBourse() + 2);

            $em->persist($b);
            $em->flush();
            return $this->json($b, 200, [], ['groups' => "glad_read"]);
        }
    }
}