<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/forgot', name: 'forgot_password_page', methods: ['GET'])]
    public function forgot(): Response
    {
        return $this->render(view: 'auth/forgot.html.twig');
    }

    #[Route('/login', name: 'login_page', methods: ['GET'])]
    public function login(): Response
    {
        return $this->render(view: 'auth/login.html.twig');
    }

    #[Route('/register', name: 'register_page', methods: ['GET'])]
    public function register(): Response
    {
        return $this->render(view: 'auth/register.html.twig');
    }

    #[Route('/reset', name: 'reset_password_page', methods: ['GET'])]
    public function reset(): Response
    {
        return $this->render(view: 'auth/reset.html.twig');
    }
}
