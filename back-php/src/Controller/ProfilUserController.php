<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile', name: 'app_')]
class ProfilUserController extends AbstractController
{
    #[Route('/', name: 'profile')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findAll();

        return $this->render('profil_user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
