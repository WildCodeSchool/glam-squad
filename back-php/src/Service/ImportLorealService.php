<?php

namespace App\Service;

use App\Entity\Loreal;
use App\Repository\LorealRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\UnavailableStream;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Statement;
use League\Csv\Reader;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @throws UnavailableStream
 */
class ImportLorealService
{
    public function __construct(
        private LorealRepository $lorealRepository,
        private EntityManagerInterface $erm,
        private SluggerInterface $slugger
    ) {
    }

    public function importLoreal(SymfonyStyle $iop): void
    {
        $iop->title('Importation des produits');
        $lorealProducts = $this->readCsvFile();

        $iop->progressStart(count($lorealProducts) * 2);
        foreach ($lorealProducts as $arrayProduct) {
            $iop->progressAdvance();
            $product = $this->createBrand($arrayProduct);
            $this->erm->persist($product);
        }

        $this->erm->flush();
        $this->addSlug($iop);
        $iop->progressFinish();
        $iop->success("c'est bien chargé !");
    }

    private function readCsvFile(): Reader
    {
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/dataframe_loreal.csv', 'r');
        $csv->setHeaderOffset(0);

        return $csv;
    }

    private function createBrand(array $arrayProduct): Loreal
    {
        $product = $this->lorealRepository->findOneBy(['brand' => $arrayProduct['brand']]);

        if (!$product) {
            $product = new Loreal();
        }

        $product->setBrand($arrayProduct['brand'])
            ->setCategory($arrayProduct['category'])
            ->setNameProduct($arrayProduct['name'])
            ->setDataAchat($arrayProduct['date_achat'])
            ->setContenanceTotale($arrayProduct['contenance_totale'])
            ->setUniteProduct($arrayProduct['unite_product'])
            ->setFrequenceJ($arrayProduct['frequence_utilisation_j'])
            ->setDureeTotal($arrayProduct['durée_total'])
            ->setDureeProduct($arrayProduct['duree_product'])
            ->setDateFinProduct($arrayProduct['date_fin_product'])
            ->setDateFinString($arrayProduct['date_fin_string'])
            ->setImgUrl($arrayProduct['img_url'])
            ->setWebsiteUrl($arrayProduct['website_url'])
           // ->setSlug($this->slugger->slug($arrayProduct['name']))
        ;

        return $product;
    }

    private function addSlug(SymfonyStyle $iop): void
    {
        $products = $this->lorealRepository->findAll();

        foreach ($products as $product) {
            $iop->progressAdvance();
            $product->setSlug($this->slugger->slug($product->getNameProduct()));
            $this->erm->flush();
        }
    }
}
