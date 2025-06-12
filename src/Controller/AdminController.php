<?php

namespace App\Controller;

use App\Repository\PlanningRepository;
use App\Repository\ChantierRepository;
use App\Repository\PersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
      public function dashboard(
        PlanningRepository $planningRepository,
        PersonnelRepository $personnelRepository,
        ChantierRepository $chantierRepository
    ): Response {
        return $this->render('admin/dashboard.html.twig', [
            'plannings' => $planningRepository->findBy([], ['date' => 'DESC'], 5),
            'personnels' => $personnelRepository->findBy([], ['id' => 'DESC'], 5),
            'chantiers' => $chantierRepository->findBy([], ['id' => 'DESC'], 5),
        ]);
    }

    #[Route('/planning', name: 'admin_planning')]
    public function planning(PlanningRepository $planningRepository): Response
    {
        return $this->render('admin/planning/planning.html.twig', [
            'plannings' => $planningRepository->findAll(),
        ]);
    }

    #[Route('/chantier', name: 'admin_chantier')]
    public function chantier(ChantierRepository $chantierRepository): Response
    {
        return $this->render('admin/chantiers/chantier.html.twig', [
            'chantiers' => $chantierRepository->findAll(),
        ]);
    }


    #[Route('/personnel', name: 'admin_personnel')]
    public function personnel(PersonnelRepository $personnelRepository): Response
    {
        return $this->render('admin/personnels/personnel.html.twig', [
            'personnels' => $personnelRepository->findAll(),
        ]);
    }
}
