<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionsController extends AbstractController
{
    #[Route('/confirm', name: 'confirm_page', methods: ['GET'])]
    public function confirm(): Response
    {
        return $this->render(view: 'subscriptions/confirm.html.twig');
    }

    #[Route('/subscriptions', name: 'subscriptions_page', methods: ['GET'])]
    public function subscrition(SubscriptionRepository $subscriptionsRepository): Response
    {
        return $this->render(view: 'subscriptions/subscriptions.html.twig', parameters: ['subscriptions' => $subscriptionsRepository->findAll()]);
    }
}
