<?php

declare(strict_types=1);

namespace App\Component\Currency;

use App\Component\Currency\CurrateApi\CurrateApiClientInterface;
use App\Component\Currency\Factory\CurrencyFactoryInterface;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

final class CurrenciesImporter
{
    public function __construct(
        private EntityManager $em,
        private CurrateApiClientInterface $apiClient,
        private CurrencyFactoryInterface $factory,
        private LoggerInterface $logger,
    ) {
        $this->apiClient = $apiClient;
        $this->factory = $factory;
        $this->logger = $logger;
    }

    public function import(): void
    {
        $currencies = $this->apiClient->getCurrencies();

        foreach ($currencies->getList() as $currencyName) {
            try {
                $currency = $this->factory->create($currencyName);
                $this->em->persist($currency);
                $this->em->flush();
            } catch (\Throwable $ex) {
                $this->logger->error('Failed to save currency item to db', [$ex->getMessage()]);
            }
        }
    }
}