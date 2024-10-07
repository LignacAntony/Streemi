<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'Home page', methods: ['GET'])]
    public function __invoke(MediaRepository $mediaRepository): Response
    {
        return $this->render('index.html.twig', [
            'medias' => $mediaRepository->findAll(),
        ]);
    }
}
