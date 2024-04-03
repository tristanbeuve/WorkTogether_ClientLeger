<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use ContainerXnxxe4H\getBaieControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaieController extends AbstractController
{
    #[Route('/baie', name: 'app_baie')]
    public function index(UserRepository $ur, ReservationRepository $rr): Response
    {

        return $this->render('baie/index.html.twig', [
        ]);
    }
}
