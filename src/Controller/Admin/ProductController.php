<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Factory\ProductFactory;
use App\Form\ProductType;
use App\Manager\ProductManager;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/product",
 *     name="admin_product_"
 * )
 */
class ProductController extends AbstractController
{
    private const LIST_PER_PAGE = 10;

    /**
     * @Route("/{page}", name="index", requirements={"page"="\d+"}, methods={"GET"})
     */
    public function index(ProductRepository $productRepository, PaginatorInterface $paginator, int $page = 1): Response
    {
        $paginationQuery = $productRepository->getPaginatorQuery();
        $pagination = $paginator->paginate($paginationQuery, $page, self::LIST_PER_PAGE);

        return $this->render('admin/product/index.html.twig', [
            'products' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        ProductFactory $productFactory,
        ProductManager $productManager
    ): Response
    {
        $product = $productFactory->create();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            $productManager->create($product, $imageFile);

            $this->addFlash('notice', 'Produkt założona');
            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Product $product,
        ProductManager $productManager
    ): Response
    {

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            $productManager->update($product, $imageFile);

            $this->addFlash('notice', 'Produkt poprawnie zapisany.');
            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        Product $product,
        ProductManager $productManager
    ): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $productManager->delete($product);
            $this->addFlash('notice', 'Produkt usunięty');
        }

        return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
