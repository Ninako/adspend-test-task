<?php

declare(strict_types=1);

namespace App\Component\Currency\Factory;

use App\Entity\Currency;

final class CurrencyFactory implements CurrencyFactoryInterface
{
    public function create(string $name): Currency
    {
        $currency = new Currency();
        $currency->setName($name);

        return $currency;
    }
}