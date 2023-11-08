<?php

namespace App\Repository;

use App\Entity\Renouvellement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Renouvellement>
 *
 * @method Renouvellement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Renouvellement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Renouvellement[]    findAll()
 * @method Renouvellement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenouvellementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Renouvellement::class);
    }

//    /**
//     * @return Renouvellement[] Returns an array of Renouvellement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Renouvellement
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
