<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Media;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MovieController extends AbstractController
{

    #[Route('/default', name: 'default_page', methods: ['GET'])]
    public function default(): Response
    {
        return $this->render(view: 'movie/default.html.twig');
    }

    #[Route('/movie/detail/{id}', name: 'movie_detail', methods: ['GET'])]
    public function detailmovie(Media $media): Response
    {
        return $this->render(view: 'movie/detail.html.twig', parameters: ['media' => $media]);
    }

    #[Route('serie/detail/{id}', name: 'serie_detail', methods: ['GET'])]
    public function detailserie(Media $media): Response
    {
        // utilisier detail.html.twig mais ajouter la diff de detail_serie.html.twig
        return $this->render(view: 'movie/detail.html.twig', parameters: ['media' => $media]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('lists', name: 'lists_page', methods: ['GET'])]
    public function lists(CategoryRepository $repository): Response
    {

        return $this->render(
            'movie/lists.html.twig',
            [
                'categories' => $repository->findAll()
            ]
        );
    }
}
