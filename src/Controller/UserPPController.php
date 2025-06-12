<?php

namespace App\Controller;

use App\Repository\PlanningRepository;
use App\Repository\PersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/userpp')]
class UserPPController extends AbstractController
{
    #[Route('/dashboard', name: 'userpp_dashboard')]
    public function dashboard(
        PlanningRepository $planningRepository,
        PersonnelRepository $personnelRepository
    ): Response {
        $plannings = $planningRepository->findAll();
        $personnels = $personnelRepository->findAll();

        return $this->render('user_pp/dashboard.html.twig', [
            'plannings' => $plannings,
            'personnels' => $personnels
        ]);
    }
}
