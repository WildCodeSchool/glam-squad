<?php

namespace App\Controller;

use App\Entity\Loreal;
use App\Repository\LorealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        LorealRepository $lorealRepository,
    ): Response {
        $id = [1, 306, 457, 462];

        $loreal1 = $lorealRepository->findOneBy(['id' => $id[0]]);
        $loreal2 = $lorealRepository->findOneBy(['id' => $id[1]]);
        $loreal3 = $lorealRepository->findOneBy(['id' => $id[2]]);
        $loreal4 = $lorealRepository->findOneBy(['id' => $id[3]]);

//        $lorealList = $lorealRepository->findBy(['id' => $id]);

//        if(!$lorealList){
        if (!$loreal1 && !$loreal2 && !$loreal3 && !$loreal4) {
            throw $this->createNotFoundException('pas d\'image associé à cette id');
        }

//        $picturePath = $lorealList->getImgUrl();

        return $this->render('home/index.html.twig', [
//            'lorealList' => $lorealList,
                'loreal1' => $loreal1,
                'loreal2' => $loreal2,
                'loreal3' => $loreal3,
                'loreal4' => $loreal4,
//            'picturePath' => $picturePath,
        ]);
    }
}
