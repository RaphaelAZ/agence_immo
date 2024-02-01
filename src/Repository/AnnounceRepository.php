<?php

namespace App\Repository;

use App\Entity\Announce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Announce>
 *
 * @method Announce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announce[]    findAll()
 * @method Announce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnounceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announce::class);
    }

    public function findByFilters($filters)
    {
        $qb = $this->createQueryBuilder('a');

        if ($filters['title']) {
            $qb->andWhere('a.title LIKE :title')
                ->setParameter('title', '%' . $filters['title'] . '%');
        }

        if ($filters['minPrice']) {
            $qb->andWhere('a.price >= :minPrice')
                ->setParameter('minPrice', $filters['minPrice']);
        }

        if ($filters['maxPrice']) {
            $qb->andWhere('a.price <= :maxPrice')
                ->setParameter('maxPrice', $filters['maxPrice']);
        }

        if ($filters['minSurface']) {
            $qb->andWhere('a.surface >= :minSurface')
                ->setParameter('minSurface', $filters['minSurface']);
        }

        if ($filters['maxSurface']) {
            $qb->andWhere('a.surface <= :maxSurface')
                ->setParameter('maxSurface', $filters['maxSurface']);
        }

        return $qb->getQuery()->getResult();
    }
}
