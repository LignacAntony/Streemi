<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'category_page', methods: ['GET'])]
    public function category(Category $category, MediaRepository $repository): Response
    {
        $medias = $repository->findByCategoryWithPagination(
            category: $category,
            currentPage: 1,
            maxPerPage: 9,
        );

        return $this->render('movie/category.html.twig', [
            'category' => $category,
            'medias' => $medias
        ]);
    }

    #[Route('/category/async/{id}', name: 'show_category_async')]
    public function showCategoryAsync(Category $category, MediaRepository $repository, Request $request): Response
    {
        $currentPage = $request->query->getInt('page', 1);

        $medias = $repository->findByCategoryWithPagination(
            category: $category,
            currentPage: $currentPage,
            maxPerPage: 9,
        );

        return $this->render('parts/pages/movies/movie_iterable_card.html.twig', [
            'medias' => $medias
        ]);
    }

    #[Route('/discover', name: 'discover_page', methods: ['GET'])]
    public function discover(MediaRepository $mediaRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('movie/discover.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'medias' => $mediaRepository->findPopularMedias()
        ]);
    }
}
