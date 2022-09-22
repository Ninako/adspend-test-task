<?php

declare(strict_types=1);

namespace App\Component\Catalog;

use App\Component\Catalog\DTO\CatalogTreeDTO;

interface CatalogBuilderInterface
{
    public function build(int $depth): CatalogTreeDTO;
}