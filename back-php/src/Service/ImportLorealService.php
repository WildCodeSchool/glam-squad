<?php

namespace App\Service;

use App\Entity\Loreal;
use App\Repository\LorealRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\UnavailableStream;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Statement;
use League\Csv\Reader;

/**
 * @throws UnavailableStream
 */
class ImportLorealService
{
    public function __construct(
        private LorealRepository $lorealRepository,
        private EntityManagerInterface $erm,
    ) {
    }

    public function importLoreal(SymfonyStyle $iop): void
    {
        $iop->title('Importation des produits');
        $lorealProducts = $this->readCsvFile();

        $iop->progressStart(count($lorealProducts));
        foreach ($lorealProducts as $arrayProduct) {
            $iop->progressAdvance();
            $product = $this->createBrand($arrayProduct);
            $this->erm->persist($product);
        }

        $this->erm->flush();
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
            ->setName($arrayProduct['name'])
            ->setDataAchat($arrayProduct['date_achat'])
            ->setContenanceTotale($arrayProduct['contenance_totale'])
            ->setUniteProduct($arrayProduct['unite_product'])
            ->setFrequenceJ($arrayProduct['frequence_utilisation_j'])
            ->setDureeTotal($arrayProduct['durée_total'])
            ->setDureeProduct($arrayProduct['duree_product'])
            ->setDateFinProduct($arrayProduct['date_fin_product'])
            ->setDateFinString($arrayProduct['date_fin_string'])
            ->setImgUrl($arrayProduct['img_url'])
            ->setWebsiteUrl($arrayProduct['website_url']);

        return $product;
    }
}
