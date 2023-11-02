<?php

namespace App\Controller;

use App\Entity\Abonnement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(EntityManagerInterface $em): Response
    {
        $abonnement = $em->getRepository(Abonnement::class)->findAll();

                return $this->render('abonnement/index.html.twig', [
            'controller_name' => 'AbonnementController',
                    'abonnements'=> $abonnement,
        ]);
    }
}
