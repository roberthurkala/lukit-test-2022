<?php

namespace App\Controller\Site;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/category",
 *      name="category_"
 * )
 */
class CategoryController extends AbstractController
{
    private const LIST_PER_PAGE = 10;

    /**
     * @Route("/{id}/{page}", name="index", requirements={"page"="\d+"}, methods={"GET"})
     */
    public function index(
        Category $category,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        PaginatorInterface $paginator,
        int $page = 1
    ): Response
    {
        $paginationQuery = $productRepository->getPaginatorQuery($category);
        $pagination = $paginator->paginate($paginationQuery, $page, self::LIST_PER_PAGE);

        return $this->render('site/category/index.html.twig', [
            'products' => $pagination,
            'category' => $category
        ]);
    }
}
