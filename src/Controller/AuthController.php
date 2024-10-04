<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/forgot', name: 'Forgot password page', methods: ['GET'])]
    public function forgot(): Response
    {
        return $this->render(view: 'forgot.html.twig');
    }

    #[Route('/login', name: 'Login page', methods: ['GET'])]
    public function login(): Response
    {
        return $this->render(view: 'login.html.twig');
    }

    #[Route('/register', name: 'Register page', methods: ['GET'])]
    public function register(): Response
    {
        return $this->render(view: 'register.html.twig');
    }

    #[Route('/reset', name: 'Reset password page', methods: ['GET'])]
    public function reset(): Response
    {
        return $this->render(view: 'reset.html.twig');
    }
}
