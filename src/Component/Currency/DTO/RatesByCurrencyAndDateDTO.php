<?php

declare(strict_types=1);

namespace App\Component\Currency\DTO;

class RatesByCurrencyAndDateDTO
{
    private array $list = [];
    private \DateTimeImmutable $date;

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $data): void
    {
        $this->list = [];

        foreach ($data as $currency => $rate) {
            $itemDto = new RateByCurrencyAndDateDTO();
            $itemDto->setCurrencyPair($currency);
            $itemDto->setRate($rate);
            $itemDto->setDate($this->date);
            $this->list[] = $itemDto;
        }
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