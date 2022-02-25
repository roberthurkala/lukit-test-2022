<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getPaginatorQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->addOrderBy('c.name', 'ASC');
    }

    public function findMainCategories(): array
    {
        $qb = $this->createQueryBuilder('c');

        return $qb
            ->where($qb->expr()->isNull("c.parentCategory"))
            ->getQuery()->getResult();
    }
}
