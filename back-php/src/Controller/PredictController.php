<?php

namespace App\Controller;

use App\Repository\LorealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PredictController extends AbstractController
{
    #[Route('/predict', name: 'predict')]
    public function index(LorealRepository $lorealRepository, Request $request): Response
    {
        $param = [];
        if ($request->query->has('slug')) {
            $slug = $request->query->get('slug');
            $product = $lorealRepository->findOneBy(['slug' => $slug]);
            $param['product'] = $product;
        }
        return $this->render('predict.html.twig', $param);
    }
}
