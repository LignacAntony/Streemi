<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class AuthController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(
        private EntityManagerInterface $entMan
    ) {
        $this->entityManager = $entMan;
    }


    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

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

    #[Route('/forgot', name: 'forgot_password_page_get', methods: ['GET'])]
    public function forgot_get(): Response
    {
        return $this->render(view: 'auth/forgot.html.twig');
    }

    #[Route('/forgot', name: 'forgot_password_page_post', methods: ['POST'])]
    public function forgot_post(
        Request $request,
        UserRepository $user,
        MailerInterface $mailer,
        TokenGeneratorInterface $tokenGenerator,
    ): Response {

        $email = $request->get('_email');
        if (!$email) {
            $this->addFlash('error', 'Utilisateur non trouvé');
            return $this->redirectToRoute('forgot_password_page_post');
        }

        $user = $user->findOneByEmail($email);
        if (!$user) {
            $this->addFlash('error', 'Utilisateur non trouvé');
            return $this->redirectToRoute('forgot_password_page_post');
        }

        $token = $tokenGenerator->generateToken();
        $user->setResetToken($token);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $url = $this->generateUrl('reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

        $context = compact('url', 'user');

        $email_to = (new Email())
            ->from('onboarding@resend.dev')
            ->to($user->getEmail())
            ->subject('Reset password')
            ->text('Sending you the link to reet your password')
            ->html(sprintf(
                '<p>Bonjour %s</p>
                <p>Pour votre demande de réinitialisation de mot de passe, veuillez cliquer sur le lien suivant : <a href="%s">Réinitialiser votre mot de pass</a></p>
                <p>Merci</p>',
                htmlspecialchars($user->getUsername()),
                htmlspecialchars($url),
            ));

        $mailer->send($email_to);

        return $this->redirectToRoute('app_login');
    }

    #[Route('/oubli-password/{token}', name: 'reset_password')]
    public function resetPass(
        string $token,
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = $userRepository->findOneByResetToken($token);

        if (!$user) {
            $this->addFlash('danger', 'Jeton invalide');
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ResetPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setResetToken('');

            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe changé avec succès');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('auth/reset.html.twig', [
            'passForm' => $form->createView()
        ]);
    }
}
