<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Factory\CategoryFactory;
use App\Form\CategoryType;
use App\Manager\CategoryManager;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/admin/category",
 *      name="admin_category_"
 * )
 */
class CategoryController extends AbstractController
{
    private const LIST_PER_PAGE = 10;

    /**
     * @Route("/{page}", name="index", requirements={"page"="\d+"}, methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository, PaginatorInterface $paginator, int $page = 1): Response
    {
        $paginationQuery = $categoryRepository->getPaginatorQuery();
        $pagination = $paginator->paginate($paginationQuery, $page, self::LIST_PER_PAGE);

        return $this->render('admin/category/index.html.twig', [
            'categories' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        CategoryFactory $categoryFactory,
        CategoryManager $categoryManager
    ): Response
    {
        $category = $categoryFactory->create();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryManager->create($category);

            $this->addFlash('notice', 'Kategoria założona');
            return $this->redirectToRoute('admin_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Category $category,
        CategoryManager $categoryManager
    ): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryManager->update($category);

            $this->addFlash('notice', 'Kategoria poprawnie zapisana.');
            return $this->redirectToRoute('admin_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        Category $category,
        CategoryManager $categoryManager
    ): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $categoryManager->delete($category);
            $this->addFlash('notice', 'Kategoria usunięta');
        }

        return $this->redirectToRoute('admin_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
