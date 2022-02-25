<?php

namespace App\Controller\Site;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/product",
 *      name="product_"
 * )
 */
class ProductController extends AbstractController
{
    private const LIST_PER_PAGE = 10;

    /**
     * @Route("/{id}/show", name="show", methods={"GET"})
     */
    public function show(
        Product $product
    ): Response
    {

        return $this->render('site/product/show.html.twig', [
            'product' => $product,
            'category' => $product->getCategory()
        ]);
    }
}
