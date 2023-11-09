<?php

namespace App\Controller;

use App\Entity\Baie;
use App\Entity\Renouvellement;
use App\Entity\Reservation;
use App\Entity\Unite;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
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

        $id= $this->getUser()->getId();
        $user = $ur->findOneBy(['id'=>$id]);
        $reservations = $rr->findByUser($id);

        return $this->render('reservation/index.html.twig', [
            'baies'=>$baies,
            'unites'=>$unites,
            'id'=>$id,
            'reservations'=>$reservations,
        ]);
    }

    #[Route('/reserver', name: 'app_new_reservation')]
    #[IsGranted('ROLE_USER')]
    public function new(UserRepository $ur, Request $request, EntityManagerInterface $em): Response
    {
        $id= $this->getUser()->getId();
        $user = $ur->findOneBy(['id'=>$id]);

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();
            $date1=new DateTime('now');
            $date2=new DateTime('now');
            $dateDeb = $date1;
            $reservation->setDateDeb($dateDeb);
            $renouvel=$form['renouvellement']->getData();
            if ($renouvel->getnom() == 'An'){
                $interval = new \DateInterval('P1Y');
            }
            else{
                $interval = new \DateInterval('P1M');
            }
            $dateEnd = $date2->add($interval);
            $reservation->setDateEnd($dateEnd);
            $reservation->setCustomer($user);
            $em->persist($reservation);
            $em->flush();
            $this->addFlash(
                'success',
                "Abonnement correctement réservé"
            );
            return $this->redirectToRoute('app_reservation', [
                ]);
        }
        return $this->render('reservation/new.html.twig', [
            'form' => $form
        ]);
    }
}