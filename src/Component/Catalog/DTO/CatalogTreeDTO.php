<?php

declare(strict_types=1);

namespace App\Component\Catalog\DTO;

final class CatalogTreeDTO
{
    private array $catalogTree = [];

    public function getCatalogTree(): array
    {
        return $this->catalogTree;
    }

    public function setCatalogTree(array $catalogTree): void
    {
        $this->catalogTree = $catalogTree;
    }
}