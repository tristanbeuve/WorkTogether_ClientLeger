<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Redis;

class HomeController extends AbstractController
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    #[Route('/home', name: 'app_home')]
    public function index(UserRepository $ur, ReservationRepository $rr): Response
    {
        // the following code will test if monolog integration logs to sentry
        $this->logger->error('My custom logged error.');

        // the following code will test if an uncaught exception logs to sentry
        throw new \RuntimeException('Example exception.');

//        return $this->render('home/index.html.twig', [
//        ]);
    }
}
