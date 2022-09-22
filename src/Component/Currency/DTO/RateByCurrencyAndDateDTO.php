<?php

declare(strict_types=1);

namespace App\Component\Currency\DTO;

class RateByCurrencyAndDateDTO
{
    private string $currencyPair;
    private float $rate;
    private \DateTimeImmutable $date;

    public function getCurrencyPair(): string
    {
        return $this->currencyPair;
    }

    public function setCurrencyPair(string $currencyPair): void
    {
        $this->currencyPair = $currencyPair;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): void
    {
        $this->date= $date;
    }
}