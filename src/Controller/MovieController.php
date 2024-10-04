<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/category', name: 'Category page', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render(view: 'movie/category.html.twig');
    }

    #[Route('/default', name: 'Default page', methods: ['GET'])]
    public function default(): Response
    {
        return $this->render(view: 'movie/default.html.twig');
    }

    #[Route('/movie/{name}', name: 'Movie detail page', methods: ['GET'])]
    public function detailmovie($name): Response
    {
        return $this->render(view: 'movie/detail.html.twig', parameters: [$name]);
    }

    #[Route('serie/{name}', name: 'Serie detail page', methods: ['GET'])]
    public function detailserie($name): Response
    {
        return $this->render(view: 'movie/detail_serie.html.twig', parameters: [$name]);
    }

    #[Route('discover', name: 'Discover page', methods: ['GET'])]
    public function discover(): Response
    {
        return $this->render(view: 'movie/discover.html.twig');
    }

    #[Route('lists', name: 'Lists page', methods: ['GET'])]
    public function lists(): Response
    {
        return $this->render(view: 'movie/lists.html.twig');
    }
}
