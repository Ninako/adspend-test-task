<?php

declare(strict_types=1);

namespace App\Component\Currency\DTO;

final class CurrencyListDTO
{
    private array $list = [];

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $data): void
    {
        $this->list = $data;
    }
}