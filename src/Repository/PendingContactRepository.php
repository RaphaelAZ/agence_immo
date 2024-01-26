<?php

namespace App\Repository;

use App\Entity\PendingContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PendingContact>
 *
 * @method PendingContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method PendingContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method PendingContact[]    findAll()
 * @method PendingContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PendingContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PendingContact::class);
    }

//    /**
//     * @return PendingContact[] Returns an array of PendingContact objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PendingContact
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
