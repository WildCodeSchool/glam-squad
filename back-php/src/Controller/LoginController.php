<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use SymfonyCasts\VerifyEmail\Bundle;

class LoginController extends AbstractController
{
    #[Route('/auth', name: 'app_auth')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new User();
        $registerForm = $this->createForm(RegistrationFormType::class, $user);
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'form' => $registerForm
        ]);
    }


}
