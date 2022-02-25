<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_PRODUCT_1 = 'PRODUCT_1';

    public function load(ObjectManager $manager): void
    {
        /** @var Category $category */
        $category = $this->getReference(CategoryFixtures::REFERENCE_CATEGORY_1);

        /** @var Category $category2 */
        $category2 = $this->getReference(CategoryFixtures::REFERENCE_CATEGORY_2);

        $product = (new Product())
            ->setName('Czapka z daszkiem niebieska')
            ->setDescription('Nadruki wykonane w technologii DTG. Bluzę należy wyprać przed pierwszym założeniem, aby nabrała odpowiedniej miękkości. Prać ręcznie oraz prasować na lewej stronie.')
            ->setPrice(20)
            ->setImageFilename('product1-6218f7b457f0b7.34712546.jpg')
            ->setCategory($category);
        $manager->persist($product);

        $product1 = (new Product())
            ->setName('Bluza zielona')
            ->setDescription('Nadruki wykonane w technologii DTG. Bluzę należy wyprać przed pierwszym założeniem, aby nabrała odpowiedniej miękkości. Prać ręcznie oraz prasować na lewej stronie.')
            ->setPrice(129)
            ->setImageFilename('product-6218f7ac44cff1.91735298.jpg')
            ->setCategory($category2);
        $manager->persist($product1);

        $product2 = (new Product())
            ->setName('Czapka z daszkiem')
            ->setDescription('Nadruki wykonane w technologii DTG. Bluzę należy wyprać przed pierwszym założeniem, aby nabrała odpowiedniej miękkości. Prać ręcznie oraz prasować na lewej stronie.')
            ->setPrice(59)
            ->setImageFilename('product1-6218f7b457f0b7.34712546.jpg')
            ->setCategory($category);
        $manager->persist($product2);

        $product3 = (new Product())
            ->setName('Bluza czerwona')
            ->setDescription('Nadruki wykonane w technologii DTG. Bluzę należy wyprać przed pierwszym założeniem, aby nabrała odpowiedniej miękkości. Prać ręcznie oraz prasować na lewej stronie.')
            ->setPrice(199)
            ->setImageFilename('product-6218f7ac44cff1.91735298.jpg')
            ->setCategory($category2);
        $manager->persist($product3);

        $product4 = (new Product())
            ->setName('Czapka zimowa')
            ->setDescription('Nadruki wykonane w technologii DTG. Bluzę należy wyprać przed pierwszym założeniem, aby nabrała odpowiedniej miękkości. Prać ręcznie oraz prasować na lewej stronie.')
            ->setPrice(3)
            ->setImageFilename('product1-6218f7b457f0b7.34712546.jpg')
            ->setCategory($category);
        $manager->persist($product4);

        $product5 = (new Product())
            ->setName('Czapka z daszkiem')
            ->setDescription('Nadruki wykonane w technologii DTG. Bluzę należy wyprać przed pierwszym założeniem, aby nabrała odpowiedniej miękkości. Prać ręcznie oraz prasować na lewej stronie.')
            ->setPrice(20)
            ->setImageFilename('product-6218f7ac44cff1.91735298.jpg')
            ->setCategory($category2);
        $manager->persist($product5);

        $manager->flush();

        $this->addReference(self::REFERENCE_PRODUCT_1, $product);
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
