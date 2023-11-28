<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Class\UnsplashClass;
use Unsplash\Photo;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(UserRepository $ur,ReservationRepository $rr, UnsplashClass $UC): Response
    {

//        $filters = [
//            'query'    => 'coffee',
//        ];
//        $photo = Photo::random($filters);
//

        return $this->render('home/index.html.twig', [
        ]);
    }

}
