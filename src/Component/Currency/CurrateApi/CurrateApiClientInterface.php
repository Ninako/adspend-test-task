<?php

declare(strict_types=1);

namespace App\Component\Currency\CurrateApi;

use App\Component\Currency\DTO\CurrencyListDTO;
use App\Component\Currency\DTO\RatesByCurrencyAndDateDTO;

interface CurrateApiClientInterface
{
    public function getCurrencies(): CurrencyListDTO;

    public function getRatesByCurrencyAndDate(array $currencyPairs, $date): RatesByCurrencyAndDateDTO;
}