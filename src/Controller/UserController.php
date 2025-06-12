<?php

namespace App\Controller;

use App\Repository\PlanningRepository;
use App\Repository\ChantierRepository;
use App\Repository\PersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/dashboard', name: 'user_dashboard')]
    public function dashboard(
        PlanningRepository $planningRepository,
        ChantierRepository $chantierRepository,
        PersonnelRepository $personnelRepository
    ): Response {
        $user = $this->getUser();
        $personnel = $user?->getPersonnel();

        $plannings = [];

        if ($personnel) {
            $plannings = $planningRepository->createQueryBuilder('p')
                ->leftJoin('p.employes', 'e')
                ->where('e = :personnel')
                ->setParameter('personnel', $personnel)
                ->getQuery()
                ->getResult();
        }

        return $this->render('user/dashboard.html.twig', [
            'plannings' => $plannings,
            'personnel' => $personnel,
        ]);
    }

    #[Route('/planning', name: 'user_planning')]
    public function planning(PlanningRepository $planningRepository): Response
    {
        $personnel = $this->getUser()?->getPersonnel();

        $plannings = [];

        if ($personnel) {
            $plannings = $planningRepository->createQueryBuilder('p')
                ->leftJoin('p.employes', 'e')
                ->where('e = :personnel')
                ->setParameter('personnel', $personnel)
                ->getQuery()
                ->getResult();
        }

        return $this->render('user/planning.html.twig', [
            'plannings' => $plannings,
        ]);
    }

    #[Route('/fiche', name: 'user_fiche')]
    public function fiche(): Response
    {
        $personnel = $this->getUser()?->getPersonnel();

        return $this->render('user/fiche_personnel.html.twig', [
            'personnel' => $personnel,
        ]);
    }

    #[Route('/chantiers', name: 'user_chantiers')]
    public function chantiers(PlanningRepository $planningRepository): Response
    {
        $personnel = $this->getUser()?->getPersonnel();

        $chantiersAvenir = [];
        $chantiersPasses = [];

        if ($personnel) {
            $plannings = $planningRepository->createQueryBuilder('p')
                ->leftJoin('p.employes', 'e')
                ->where('e = :personnel')
                ->setParameter('personnel', $personnel)
                ->getQuery()
                ->getResult();

            $now = new \DateTime();

            foreach ($plannings as $planning) {
                $chantier = $planning->getChantier();
                $date = $planning->getDate();

                if ($chantier && $date) {
                    if ($date >= $now) {
                        $chantiersAvenir[$chantier->getId()] = $chantier;
                    } else {
                        $chantiersPasses[$chantier->getId()] = $chantier;
                    }
                }
            }
        }

        return $this->render('user/voir_chantiers.html.twig', [
            'chantiers_a_venir' => $chantiersAvenir,
            'chantiers_passes' => $chantiersPasses,
        ]);
    }
}
