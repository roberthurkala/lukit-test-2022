<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const REFERENCE_CATEGORY_1 = 'CATEGORY_1';
    public const REFERENCE_CATEGORY_2 = 'CATEGORY_2';

    public function load(ObjectManager $manager): void
    {
        $category = (new Category())
            ->setName('Spodnie');
        $manager->persist($category);

        $category1 = (new Category())
            ->setName('Koszulki');
        $manager->persist($category1);

        $category2 = (new Category())
            ->setName('Damskie')
            ->setParentCategory($category);
        $manager->persist($category2);

        $category3 = (new Category())
            ->setName('Męskie')
            ->setParentCategory($category);
        $manager->persist($category3);

        $category4 = (new Category())
            ->setName('Damskie')
            ->setParentCategory($category1);
        $manager->persist($category4);

        $category5 = (new Category())
            ->setName('Męskie')
            ->setParentCategory($category1);
        $manager->persist($category5);

        $manager->flush();

        $this->addReference(self::REFERENCE_CATEGORY_1, $category);
        $this->addReference(self::REFERENCE_CATEGORY_2, $category1);
    }
}
