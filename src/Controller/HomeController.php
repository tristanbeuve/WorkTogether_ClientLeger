<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $estconnecte = $this->isGranted('ROLE_USER');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'estConnecte' => $estconnecte,
        ]);
    }
}
