<?php

namespace App\Repository;

use App\Entity\Unite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends ServiceEntityRepository<Unite>
 *
 * @method Unite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Unite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Unite[]    findAll()
 * @method Unite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UniteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unite::class);
    }

//    /**
//     * @return Unite[] Returns an array of Unite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    /**
     * @return int Returns an array of Baie objects
     */
    public function CountUnite($value): int
    {
//    SELECT COUNT(u.id)
//FROM YourBundle\Entity\Unite u
//WHERE u.status = 0
//GROUP BY u.status;

        return $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->andWhere('u.status = :val')
            ->setParameter('val', $value)
//            ->groupBy('u.status')
            ->getQuery()
            ->getSingleScalarResult();

    }


//    public function findOneBySomeField($value): ?Unite
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
