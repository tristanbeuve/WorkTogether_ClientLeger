<?php

namespace App\Class;

use App\Entity\Unite;
use App\Repository\UniteRepository;
use Doctrine\ORM\EntityManagerInterface;

class ReservationClass{


    public function MaxUnit(EntityManagerInterface $em, UniteRepository $ur){
        $uniteMax=$ur->CountUnite(0);
        return $uniteMax;
    }


//    public function duration(){
//
//        if ($renouvellement == 'An'){
//            $interval = new \DateInterval('P1Y');
//        }
//        else{
//            $interval = new \DateInterval('P1M');
//        }
//        return $interval;
//    }


}