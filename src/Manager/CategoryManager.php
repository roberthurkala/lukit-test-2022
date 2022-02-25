<?php


namespace App\Manager;


use App\Entity\Category;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Category $category): void
    {
        $this->em->persist($category);
        $this->em->flush();
    }

    public function update(Category $category): void
    {
        $category->setUpdateAt(new DateTimeImmutable());

        $this->em->persist($category);
        $this->em->flush();
    }

    public function delete(Category $category): void
    {
        $this->em->remove($category);
        $this->em->flush();
    }
}