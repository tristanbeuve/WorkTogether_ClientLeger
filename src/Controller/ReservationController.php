<?php

namespace App\Controller;

use App\Dto\RegisterDto;
use App\Dto\ReservationDto;
use App\Entity\Abonnement;
use App\Entity\Baie;
use App\Entity\Renouvellement;
use App\Entity\Reservation;
use App\Entity\Unite;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\ReservationType;
use App\Repository\AbonnementRepository;
use App\Repository\ReservationRepository;
use App\Repository\UniteRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use function Symfony\Component\Clock\now;

class ReservationController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/reservations', name: 'app_reservation')]
    public function index(ReservationRepository $rr, UserRepository $ur, EntityManagerInterface $em): Response
    {
        $unites = $em->getRepository(Unite::class)->findAll();
        $baies = $em->getRepository(Baie::class)->findAll();

        $id = $this->getUser()->getId();
        $user = $ur->findOneBy(['id' => $id]);
        $reservations = $rr->findByUser($id);

        return $this->render('reservation/index.html.twig', [
            'baies' => $baies,
            'unites' => $unites,
            'id' => $id,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reserver', name: 'app_new_reservation')]
    #[IsGranted('ROLE_USER')]
    public function new(UserRepository $ur, AbonnementRepository $ar, UniteRepository $urr, Request $request, ReservationDto $dto, EntityManagerInterface $em): Response
    {
        $id = $this->getUser()->getId();
        $user = $ur->findOneBy(['id' => $id]);

        $dataReservation = new ReservationDto();
        $form = $this->createForm(ReservationType::class, $dataReservation);
        $form->handleRequest($request);


//        $abo = $ar->findOneBy(['id' => $dataReservation->IdentifiantAbonnement])->getNbrEmplacement();
//        if ($dataReservation->quantity * $ar->findOneBy(['id' => $dataReservation->IdentifiantAbonnement])->getNbrEmplacement()<= $urr->CountUnite(0)) {
//            $form->addError("Il n'y a pas assez d'unités disponible. Veuillez réessayer plus tard");
//        }
        if ($form->isSubmitted() && $form->isValid()) {

            $reservation= new Reservation();
            $reservation->setIdentifiantAbonnement($dataReservation->IdentifiantAbonnement);
            $reservation->setQuantity($dataReservation->quantity);
            $reservation->setRenAuto($dataReservation->ren_auto);
            $reservation->setRenouvellement($dataReservation->renouvellement);
            if ($dataReservation->renouvellement->getNom() == "Mois"){
                $duration = new \DateInterval("P1M");
            }
            if ($dataReservation->renouvellement->getNom() == 'An'){
                $duration = new \DateInterval("P1Y");
            }
            $reservation->setDateEndForm($duration);

            $reservation->setCustomer($user);
            $em->persist($reservation);
            $em->flush();

            $this->addFlash(
                'reservationSuccess',
                "Abonnement correctement réservé"
            );
            return $this->redirectToRoute('app_reservation', [
            ]);
        }
        return $this->render('reservation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}