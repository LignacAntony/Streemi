<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionsController extends AbstractController
{
    #[Route('/confirm', name: 'Confirm page', methods: ['GET'])]
    public function confirm(): Response
    {
        return $this->render(view: 'subscriptions/confirm.html.twig');
    }

    #[Route('/subscriptions', name: 'Subscriptions page', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render(view: 'subscriptions/subscriptions.html.twig');
    }
}
