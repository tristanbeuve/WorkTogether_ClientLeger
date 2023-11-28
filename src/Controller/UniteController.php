<?php

namespace App\Controller;

use App\Entity\Baie;
use App\Entity\Unite;
use App\Form\UniteType;
use App\Repository\ReservationRepository;
use App\Repository\UniteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\BaieRepository;

class UniteController extends AbstractController
{
    #[Route('/unite', name: 'app_unite')]
    public function index(ReservationRepository $rr, BaieRepository $br, UniteRepository $urr, UserRepository $ur): Response
    {
        $baiesLibre=$br->CountBaie(0);
        $unitesLibre=$urr->CountUnite(0);

        return $this->render('unite/index.html.twig', [
            'baiesLibre'=>$baiesLibre,
            'unitesLibre'=>$unitesLibre,

        ]);
    }


//    #[Route('/vos_unites', name: 'app_vos_unite')]
//    public function list(EntityManagerInterface $em, int $id): Response
//    {
//        $unite = $em->getRepository(Unite::class)->find($id);
//
//        return $this->render('unite/userUnite.html.twig', [
//            'unite' => $unite,
//        ]);
//    }
//
//
//    #[Route('/unite/detail', name: 'app_unite_details')]
//    public function detail(EntityManagerInterface $em, Request $request): Response
//    {
//        $id = $request->query->getInt('id');
//        $unite = $em->getRepository(Unite::class)->find($id);
//
//        return $this->render('unite/userUnite.html.twig', [
//            'unite' => $unite,
//            'id' => $id,
//        ]);
//    }
//
//    #[IsGranted('ROLE_ADMIN')]
//    #[Route('/unite/new', name: 'app_unite_new')]
//    public function new(EntityManagerInterface $em, Request $request): Response
//    {
//        $unite = new Unite();
//
//        $form = $this->createForm(UniteType::class, $unite);
//
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $unite = $form->getData();
//            $em->persist($unite);
//            $em->flush();
//            $this->addFlash(
//                'success',
//                "Ajout d'unité effectuée"
//            );
//            $unites = $em->getRepository(Unite::class)->findAll();
//            $baies = $em->getRepository(Baie::class)->findAll();
//            return $this->render("unite/index.html.twig", [
//                'unites' => $unites,
//                'baies' => $baies,
//            ]);
//        }
//
//        return $this->render('unite/new.html.twig', [
//            'form' => $form
//        ]);
//    }
//
//
//
}