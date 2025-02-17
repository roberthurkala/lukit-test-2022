<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getPaginatorQuery(Category $category = null): QueryBuilder
    {
        $query = $this->createQueryBuilder('p');

        if ($category && $category->getParentCategory()) {
            $query
                ->where('p.category = :category')
                ->setParameter('category', $category);
        } elseif ($category) {
            $query
                ->leftJoin('p.category', 'c')
                ->where('c.parentCategory = :category')
                ->orWhere('p.category = :category')
                ->setParameter('category', $category);
        }
        $query
            ->addOrderBy('p.name', 'ASC');

        return $query;
    }
}
