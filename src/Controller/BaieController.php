<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaieController extends AbstractController
{
    #[Route('/baie', name: 'app_baie')]
    public function index(): Response
    {
        return $this->render('baie/index.html.twig', [
            'controller_name' => 'BaieController',
        ]);
    }
}
