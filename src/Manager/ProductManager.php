<?php


namespace App\Manager;


use App\Entity\Product;
use App\Service\ProductImageService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductManager
{
    private $em;
    private $productImageService;

    public function __construct(EntityManagerInterface $em, ProductImageService $productImageService)
    {
        $this->em = $em;
        $this->productImageService = $productImageService;
    }

    public function create(Product $product, ?UploadedFile $image): void
    {
        if ($image) {
            $newFileName = $this->productImageService->upload($image);
            $product->setImageFilename($newFileName);
        }
        $this->em->persist($product);
        $this->em->flush();
    }

    public function update(Product $product, ?UploadedFile $image): void
    {
        if ($image) {
            $newFileName = $this->productImageService->upload($image);
            $product->setImageFilename($newFileName);
        }
        $product->setUpdateAt(new DateTimeImmutable());

        $this->em->persist($product);
        $this->em->flush();
    }

    public function delete(Product $product): void
    {
        $this->em->remove($product);
        $this->em->flush();
    }
}