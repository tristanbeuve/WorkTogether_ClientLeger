<?php

namespace App\Repository;

use App\Entity\Baie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Baie>
 *
 * @method Baie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Baie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Baie[]    findAll()
 * @method Baie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Baie::class);
    }

    /**
     * @return int Returns an array of Baie objects
     */
    public function CountBaie($value): int
    {
        return $this->createQueryBuilder('b')
            ->select('COUNT(b)')
            ->andWhere('b.status = :val')
            ->setParameter('val', $value)
//            ->groupBy('b.status')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

//    public function findOneBySomeField($value): ?Baie
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
