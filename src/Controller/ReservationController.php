<?php

namespace App\Controller;

use App\Dto\RegisterDto;
use App\Dto\ReservationAboDto;
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
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use function Symfony\Component\Clock\now;

class ReservationController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/reservations', name: 'app_reservation')]
    public function index(ReservationRepository $rr, UserRepository $ur, EntityManagerInterface $em): Response
    {
        $id = $this->getUser()->getId();
        $reservations = $rr->findByUser($id);
        $nbr_reservation = count($reservations);

        return $this->render('reservation/index.html.twig', [
            'nbr_reservation' => $nbr_reservation,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reserver', name: 'app_new_abo_reservation')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function newReservationAbo(UserRepository $ur, AbonnementRepository $ar, UniteRepository $urr, Request $request, ReservationAboDto $dto, EntityManagerInterface $em): Response
    {
        $id = $this->getUser()->getId();
        $user = $ur->findOneBy(['id' => $id]);


        $dataReservation = new ReservationAboDto();
        $form = $this->createForm(ReservationType::class, $dataReservation);
        $form->handleRequest($request);


        if ($form->isSubmitted()) {

            $reservation = new Reservation();
            $reservation->setIdentifiantAbonnement($dataReservation->IdentifiantAbonnement);
            $reservation->setQuantity(1);
            $reservation->setRenAuto($dataReservation->ren_auto);
            $reservation->setRenouvellement($dataReservation->renouvellement);
            if ($dataReservation->renouvellement->getNom() == "Mois") {
                $duration = new \DateInterval("P1M");
            }
            if ($dataReservation->renouvellement->getNom() == 'An') {
                $duration = new \DateInterval("P1Y");
            }
            $reservation->setDateEndForm($duration);
            $reservation->setDateDeb();
            $reservation->setDelaie(False);
            $reservation->setNumero(strtoupper(substr($user->getNom(), 0, 3)) . 'ABO' . count($user->getReservations()) + 1);

            $uniteAboonement =$ar->findOneBy(['id' => $dataReservation->IdentifiantAbonnement])->getNbrEmplacement();
            $unites = $urr->findByAbonnement($uniteAboonement);
            if (
                count($unites) != $uniteAboonement
            ) {
                $form->addError(new FormError("Il n'y a pas assez d'unités disponible. Veuillez réessayer plus tard"));
            }

            if ($form->isValid()) {

                $user->addReservation($reservation);
                $reservation->setCustomer($user);

                foreach ($unites as $unite) {
                    $reservation->addUnite($unite);
                    $unite->setStatus(1);
                    $em->persist($reservation);
                    $em->flush();

                }
                $this->addFlash(
                    'reservationSuccess',
                    "Abonnement correctement réservé"
                );
                return $this->redirectToRoute('app_reservation', [
                ]);

            }
            $this->addFlash(
                'reservationFails',
                "Abonnement n'a pas pus être réservé"
            );
            return $this->redirectToRoute('app_abonnement', [
            ]);
        }
        return $this->render('reservation/newAbo.html.twig', [
            'form' => $form->createView(),
        ]);
    }

//
//    #[Route('/reserver', name: 'app_new_unite_reservation')]
//    #[IsGranted('ROLE_USER')]
//    public function newReservationUnite(UserRepository $ur, Request $request): Response
//    {
//        $id = $this->getUser()->getId();
//        $user = $ur->findOneBy(['id' => $id]);
//
//        $dataReservation = new ReservationAboDto();
//        $form = $this->createForm(ReservationType::class, $dataReservation);
//        $form->handleRequest($request);
//
//
////        $abo = $ar->findOneBy(['id' => $dataReservation->IdentifiantAbonnement])->getNbrEmplacement();
////        if ($dataReservation->quantity * $ar->findOneBy(['id' => $dataReservation->IdentifiantAbonnement])->getNbrEmplacement()<= $urr->CountUnite(0)) {
////            $form->addError("Il n'y a pas assez d'unités disponible. Veuillez réessayer plus tard");
////        }
//        if ($form->isSubmitted() && $form->isValid()) {
//
//
//
//            $this->addFlash(
//                'reservationSuccess',
//                "Unités correctement réservé"
//            );
//            return $this->redirectToRoute('app_reservation', [
//            ]);
//        }
//        return $this->render('reservation/newUnite.html.twig', [
//            'form' => $form->createView(),
//        ]);
//    }
}