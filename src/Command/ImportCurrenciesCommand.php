<?php

declare(strict_types=1);

namespace App\Command;

use App\Component\Currency\CurrenciesImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCurrenciesCommand extends Command
{
    public function __construct(
        private CurrenciesImporter $currencyImporter
    ) {
        $this->currencyImporter = $currencyImporter;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:currency:import')
            ->setDescription('Import currencies')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->currencyImporter->import();
            return self::SUCCESS;
        } catch (\Throwable $exception){
            return self::FAILURE;
        }
    }
}
