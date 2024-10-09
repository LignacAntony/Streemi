<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_page', methods: ['GET'])]
    public function admin(): Response
    {
        return $this->render(view: 'admin/admin.html.twig');
    }

    #[Route('/admin/addfilms', name: 'admin_add_films_page', methods: ['GET'])]
    public function adminaddfilms(): Response
    {
        return $this->render(view: 'admin/admin_add_films.html.twig');
    }

    #[Route('/admin/users', name: 'admin_users_page', methods: ['GET'])]
    public function adminusers(): Response
    {
        return $this->render(view: 'admin/admin_users.html.twig');
    }

    #[Route('/admin/upload', name: 'admin_upload_page', methods: ['GET'])]
    public function upload(): Response
    {
        return $this->render(view: 'admin/upload.html.twig');
    }
}
