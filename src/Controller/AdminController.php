<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'Admin page', methods: ['GET'])]
    public function admin(): Response
    {
        return $this->render(view: 'admin/admin.html.twig');
    }

    #[Route('/admin/addfilms', name: 'Admin add films page', methods: ['GET'])]
    public function adminaddfilms(): Response
    {
        return $this->render(view: 'admin/admin_add_films.html.twig');
    }

    #[Route('/admin/users', name: 'Admin users page', methods: ['GET'])]
    public function adminusers(): Response
    {
        return $this->render(view: 'admin/admin_users.html.twig');
    }

    #[Route('/admin/upload', name: 'Admin upload page', methods: ['GET'])]
    public function upload(): Response
    {
        return $this->render(view: 'admin/upload.html.twig');
    }
}
