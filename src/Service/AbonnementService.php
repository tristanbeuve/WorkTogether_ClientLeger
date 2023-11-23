<?php

namespace App\Service;

use App\Repository\ReservationRepository;

class AbonnementService
{
    public function countUserAbonnement(ReservationRepository $rr, $id)
    {
        $tabAbonnement = $rr->countAbonnementUser($id);
        return $tabAbonnement;
    }

}

?>