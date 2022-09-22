<?php

declare(strict_types=1);

namespace App\Component\Currency\CurrateApi;

use App\Component\Currency\DTO\CurrencyListDTO;
use App\Component\Currency\DTO\RatesByCurrencyAndDateDTO;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class CurrateApiClient implements CurrateApiClientInterface
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private LoggerInterface $logger,
        private ParameterBagInterface $parameterBag,

    ) {
        $this->httpClient = $httpClient;
        $this->parameterBag = $parameterBag;
        $this->logger = $logger;
    }

    public function getCurrencies(): CurrencyListDTO
    {
        $endpoint = sprintf(
            '%s/api/?get=currency_list&key=%s',
            $this->parameterBag->get('currate_api_url'),
            $this->parameterBag->get('currate_api_key')
        );

        $list = new CurrencyListDTO();
        $list->setList($this->sendRequest($endpoint));

        return $list;
    }

    public function getRatesByCurrencyAndDate(array $currencyPairs, $date): RatesByCurrencyAndDateDTO
    {
        $endpoint = sprintf(
            '%s/api/get=rates&pairs=%s&date=%s&key=%s',
            $this->parameterBag->get('currate_api_url'),
            implode(',', $currencyPairs),
            $date,
            $this->parameterBag->get('currate_api_key')
        );

        $list = new RatesByCurrencyAndDateDTO();
        $list->setList($this->sendRequest($endpoint));

        return $list;
    }

    private function sendRequest(string $endpoint): array
    {
        try {
            $response = $this->httpClient->request('GET', $endpoint);
            $content = $response->toArray();
            return $content['data'];
        } catch (\Throwable $exeption) {
            $this->logger->info('Failed to GET from Currate api', [$exeption->getMessage()]);
            return [];
        }
    }
}