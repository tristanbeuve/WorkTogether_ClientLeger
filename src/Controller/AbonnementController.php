<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use App\Service\AbonnementService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(AbonnementRepository $ar, ReservationRepository $rr): Response
    {
        $abonnements = $ar->findAll();



//        foreach ($abonnements as $abonnement){
//            $countReservation = $rr->findBy(array('IdentifiantAbonnement'=> $abonnement->getId()));
//        }
        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnements,

        ]);
    }

}
