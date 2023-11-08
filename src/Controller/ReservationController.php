<?php

namespace App\Controller;

use App\Entity\Renouvellement;
use App\Entity\Reservation;
use App\Form\ReservationType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use function Symfony\Component\Clock\now;

class ReservationController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservation')]
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    #[Route('/reserver', name: 'app_new_reservation')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();
            $dateDeb=new DateTime('now');
            $reservation->setDateDeb($dateDeb);
            $renouvel=$form['renouvellement']->getData();
            if ($renouvel->getnom() == 'An'){
                $interval = new \DateInterval('P1Y');
            }
            else{
                $interval = new \DateInterval('P1M');
            }
            $dateEnd = $dateDeb->add($interval);
            $reservation->setDateEnd($dateEnd);
            $em->persist($reservation);
            $em->flush();
            $this->addFlash(
                'success',
                "Abonnement correctement réservé"
            );
        }
        return $this->render('reservation/index.html.twig', [
            'form' => $form
        ]);
    }
}