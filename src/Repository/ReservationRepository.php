<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * @return Reservation[] Returns an array of Reservation objects
     */
    public function findByUser($value): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.customer = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function countAbonnementUser(int $value): array
    {
//    SELECT COUNT(c.id)
//FROM AppBundle\Entity\Client c
//INNER JOIN AppBundle\Entity\Reservation r
//    WITH c.id = r.customer
//INNER JOIN AppBundle\Entity\Abonnement a
//    WITH r.identifiantAbonnement = a.id
//WHERE a.status = 0
//GROUP BY a.status;
        return $this->createQueryBuilder('r')
            ->innerJoin('r.customer','c')
            ->innerJoin('r.IdentifiantAbonnement','a')
            ->select('a.id, COUNT(a),')
            ->andWhere('a.id = :val')
            ->setParameter('val' , $value)
            ->getQuery()
            ->getResult()
            ;

    }

//    public function findOneBySomeField($value): ?Reservation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
