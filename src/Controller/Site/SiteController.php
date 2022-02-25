<?php

namespace App\Controller\Site;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/",
 *     name="site_"
 * )
 */
class SiteController extends AbstractController
{
    private const LIST_PER_PAGE = 10;

    /**
     * @Route("{page}", name="home" , requirements={"page"="\d+"})
     */
    public function index(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        PaginatorInterface $paginator,
        int $page = 1
    ): Response
    {
        $productCategories = $categoryRepository->findMainCategories();
        $paginationQuery = $productRepository->getPaginatorQuery();
        $pagination = $paginator->paginate($paginationQuery, $page, self::LIST_PER_PAGE);

        return $this->render('site/index.html.twig', [
            'products' => $pagination,
            'productCategories' => $productCategories
        ]);
    }
}
