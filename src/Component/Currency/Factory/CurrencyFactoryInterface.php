<?php

declare(strict_types=1);

namespace App\Component\Currency\Factory;

use App\Entity\Currency;

interface CurrencyFactoryInterface
{
    public function create(string $name): Currency;
}