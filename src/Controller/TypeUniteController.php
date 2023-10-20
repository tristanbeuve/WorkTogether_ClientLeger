<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeUniteController extends AbstractController
{
    #[Route('/type/unite', name: 'app_type_unite')]
    public function index(): Response
    {
        return $this->render('type_unite/index.html.twig', [
            'controller_name' => 'TypeUniteController',
        ]);
    }
}
