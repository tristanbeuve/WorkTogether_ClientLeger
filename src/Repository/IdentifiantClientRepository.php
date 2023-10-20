<?php

namespace App\Repository;

use App\Entity\IdentifiantClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IdentifiantClient>
 *
 * @method IdentifiantClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdentifiantClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdentifiantClient[]    findAll()
 * @method IdentifiantClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentifiantClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdentifiantClient::class);
    }

//    /**
//     * @return IdentifiantClient[] Returns an array of IdentifiantClient objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IdentifiantClient
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
