<?php

namespace App\Controller;

use App\Entity\Gladiateur;
use App\Repository\GladiateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * @Route("api/training/{id}/physical",name="PhysicalTrain",methods={"POST"})
     */
    public function physicalTrain(Gladiateur $gladiateur, EntityManagerInterface $em)
    {
        if ($gladiateur->getEquilibre() > 0 && $gladiateur->getStrat() > 0) {


            if ($gladiateur->getEntrainer() === FALSE) {
                $spe = $gladiateur->getLudi()->getSpe();

                if ($spe === "course de char") {
                    $PJ = rand(2, 4);
                } else if ($spe === "lutte") {
                    $PJ = rand(3, 6);
                } else if ($spe === "athletisme") {
                    $PJ = rand(3, 5);
                }

                $UpdateValue = $this->UpdateTraining($gladiateur, $PJ);

                $gladiateur->setAdresse($UpdateValue[0])
                    ->setStrenght($UpdateValue[1])
                    ->setEquilibre($UpdateValue[2])
                    ->setVitesse($UpdateValue[3])
                    ->setStrat($UpdateValue[4])
                    ->setEntrainer(TRUE)
                ;

                $em->persist($gladiateur);
                $em->flush();
                return $this->json($gladiateur, 201, [], ['groups' => "glad_read"]);
            }
        } else {
            throw new \Exception("Vous n'avez plus assez d'équilibre et de balance");
        }
    }


    /**
     * @Route("api/training/{id}/tactique",name="tactiqueTrain",methods={"POST"})
     */
    public function tactiqueTrain(Gladiateur $gladiateur, EntityManagerInterface $em)
    {
        if ($gladiateur->getEquilibre() > 0 && $gladiateur->getStrat() > 0) {
            if ($gladiateur->getEntrainer() === FALSE) {
                $spe = $gladiateur->getLudi()->getSpe();
                $PJ  = 0;


                if ($spe === "course de char") {
                    $PJ = rand(3, 6);
                } else if ($spe === "lutte") {
                    $PJ = rand(1, 3);
                } else if ($spe === "athletisme") {
                    $PJ = rand(2, 3);
                }

                $UpdateValue = $this->UpdateTraining($gladiateur, $PJ);

                $gladiateur->setAdresse($UpdateValue[0])
                    ->setStrenght($UpdateValue[1])
                    ->setEquilibre($UpdateValue[2])
                    ->setVitesse($UpdateValue[3])
                    ->setStrat($UpdateValue[4])
                    ->setEntrainer(TRUE)
                ;

                $em->persist($gladiateur);
                $em->flush();
                return $this->json($gladiateur, 201, [], ['groups' => "glad_read"]);
            } else {
                return $this->json($gladiateur, 304, [], ['groups' => "glad_read"]);
            }
        } else {
            throw new \Exception("Vous n'avez plus assez d'équilibre et de balance");
        }
    }

    /**
     * @Route("api/training/{id}/combined",name="CombinedTrain",methods={"POST"})
     */
    public function combinedTrain(Gladiateur $gladiateur, EntityManagerInterface $em)
    {
        if ($gladiateur->getEquilibre() > 0 && $gladiateur->getStrat() > 0) {
            if ($gladiateur->getEntrainer() === FALSE) {
                $spe = $gladiateur->getLudi()->getSpe();
                $PJ  = 0;

                if ($spe === "course de char") {
                    $PJ = rand(2, 7);
                } else if ($spe === "lutte") {
                    $PJ = rand(1, 5);
                } else if ($spe === "athletisme") {
                    $PJ = rand(3, 9);
                }

                $UpdateValue = $this->UpdateTraining($gladiateur, $PJ);

                $gladiateur->setAdresse($UpdateValue[0])
                    ->setStrenght($UpdateValue[1])
                    ->setEquilibre($UpdateValue[2])
                    ->setVitesse($UpdateValue[3])
                    ->setStrat($UpdateValue[4])
                    ->setEntrainer(TRUE)
                ;

                $em->persist($gladiateur);
                $em->flush();
                return $this->json($gladiateur, 201, [], ['groups' => "glad_read"]);
            } else {
                return $this->json($gladiateur, 304, [], ['groups' => "glad_read"]);
            }
        } else {
            throw new \Exception("Vous n'avez plus assez d'équilibre et de balance");
        }
    }

    public
    function UpdateTraining($gladiateur, $PJ
    )
    {

        $adresse   = $gladiateur->getAdresse() + (0.4 * $PJ) >= 10 ? 10 : $gladiateur->getAdresse() + (0.4 * $PJ);
        $force     = $gladiateur->getStrenght() + (0.3 * $PJ) >= 10 ? 10 : $gladiateur->getStrenght() + (0.3 * $PJ);
        $equilibre = $gladiateur->getEquilibre() - (0.1 * $PJ) <= 0 ? 0 : $gladiateur->getEquilibre() - (0.1 * $PJ);
        $vitesse   = $gladiateur->getVitesse() + (0.5 * $PJ) >= 10 ? 10 : $gladiateur->getVitesse() + (0.5 * $PJ);
        $strat     = $gladiateur->getStrat() - (0.2 * $PJ) <= 0 ? 0 : $gladiateur->getStrat() - (0.2 * $PJ);

        return [$adresse, $force, $equilibre, $vitesse, $strat];
    }

    /**
     * @Route("/api/training/reset",name="ResetAllTraining",methods={"POST"})
     */
    public
    function ResetAll(GladiateurRepository $gladiateur, EntityManagerInterface $em
    )
    {
        $AllGlad = $gladiateur->findAll();
        foreach ($AllGlad as $a) {
            $a->setEntrainer(FALSE);
            $em->persist($a);
            $em->flush();
        }
        return $this->json($AllGlad, 200, [], ['groups' => "glad_read"]);
    }


}