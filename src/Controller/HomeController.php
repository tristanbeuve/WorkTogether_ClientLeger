<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Redis;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(UserRepository $ur, ReservationRepository $rr, Redis $redis): Response
    {
        return $this->render('home/index.html.twig', [
        ]);
    }


    #[Route('/redis', name: 'app_home')]
    public function redis(UserRepository $ur, ReservationRepository $rr, Redis
                                         $redis): Response
    {
        $redisClient = $redis->getClient();
        $redisClient->set('foo', 'truc');

        $redisClient->hmset("player:1234", [
            "Nom " => "Joueur 1",
            "Adresse e-mail" => "joueur1@test.com",
            "Date d'inscription" => "2024-01-24",
            "Avatar" => "avatar1.png"
        ]);

        $redisClient->hmset("player:1235", [
            "Nom " => "Joueur 2",
            "Adresse e-mail" => "joueur2@test.com",
            "Date d'inscription" => "2024-01-25",
            "Avatar" => "avatar2.png"
        ]);

        $redisClient->hmset("player:1236", [
            "Nom " => "Joueur 3",
            "Adresse e-mail" => "joueur3@test.com",
            "Date d'inscription" => "2024-01-26",
            "Avatar" => "avatar3.png"
        ]);

        $redisClient->hmset("player:1237", [
            "Nom " => "Joueur 4",
            "Adresse e-mail" => "joueur4@test.com",
            "Date d'inscription" => "2024-01-27",
            "Avatar" => "avatar4.png"
        ]);

        $redisClient->hmset("player:1238", [
            "Nom " => "Joueur 5",
            "Adresse e-mail" => "joueur5@test.com",
            "Date d'inscription" => "2024-01-28",
            "Avatar" => "avatar5.png"
        ]);

        $redisClient->hmset("player:1239", [
            "Nom " => "Joueur 6",
            "Adresse e-mail" => "joueur6@test.com",
            "Date d'inscription" => "2024-01-29",
            "Avatar" => "avatar6.png"
        ]);

        $redisClient->hmset("player:1240", [
            "Nom " => "Joueur 7",
            "Adresse e-mail" => "joueur7@test.com",
            "Date d'inscription" => "2024-01-30",
            "Avatar" => "avatar7.png"
        ]);

        $redisClient->zadd("1234", "5000");
        $redisClient->zadd("1235", "4800");
        $redisClient->zadd("1236", "5500");
        $redisClient->zadd("1237", "4200");
        $redisClient->zadd("1238", "5100");
        $redisClient->zadd("1239", "4700");
        $redisClient->zadd("1240", "5200");

        $redisClient->zadd("1236", "5500");
        $redisClient->zadd("1237", "4200");
        $redisClient->zadd("1238", "5100");
        $redisClient->zadd("1239", "4700");
        $redisClient->zadd("1240", "5200");

        return $this->render('home/index.html.twig', [
        ]);
    }
}
