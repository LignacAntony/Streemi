<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class AuthController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/register', name: 'register_page', methods: ['GET'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        // $user = new User();
        // $form = $this->createForm(RegistrationFormType::class, $user);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     // encode the plain password
        //     $user->setPassword(
        //         $passwordHasher->hashPassword(
        //             $user,
        //             $form->get('password')->getData()
        //         )
        //     );
        //     $entityManager->persist($user);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('home_page');
        // }

        return $this->render(view: 'auth/register.html.twig');
    }

    #[Route('/reset', name: 'reset_password_page', methods: ['GET'])]
    public function reset(): Response
    {
        return $this->render(view: 'auth/reset.html.twig');
    }

    #[Route('/forgot', name: 'forgot_password_page', methods: ['GET'])]
    public function forgot(Request $request, UserRepository $user, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $email = $request->get('email');
        if ($email) {
            try {
                $user = $user->findOneByEmail($email);
                $resetToken = Uuid::v6();
                $user->setResetToken($resetToken->toString());
                $entityManager->persist($user);
                $entityManager->flush();

                // $email = (new TemplatedEmail())
                //     ->htmlTemplate('auth/reset.html.twig')
                //     ->context($context);
                // $bodyRenderer->render($email);

                // $mailer->send($email);
            } catch (\Exception $e) {
                return $this->addFlash('error', 'Utilisateur non trouvé');
            }
        }
        return $this->render(view: 'auth/forgot.html.twig');
    }
}
