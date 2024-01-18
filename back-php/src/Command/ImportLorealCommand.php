<?php

namespace App\Command;

use App\Service\ImportLorealService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:import-product')]
class ImportLorealCommand extends Command
{
    public function __construct(
        private ImportLorealService $importLorealService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $iop = new SymfonyStyle($input, $output);
        $this->importLorealService->importLoreal($iop);

        return Command::SUCCESS;
    }
}
