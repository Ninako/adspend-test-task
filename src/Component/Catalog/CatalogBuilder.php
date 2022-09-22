<?php

declare(strict_types=1);

namespace App\Component\Catalog;

use App\Component\Catalog\DTO\CatalogTreeDTO;
use App\Repository\CategoryRepository;

final class CatalogBuilder implements CatalogBuilderInterface
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function build(int $depth): CatalogTreeDTO
    {
        $tree = $this->buildTree($depth);
        $catalogDTO = new CatalogTreeDTO();
        $catalogDTO->setCatalogTree($tree);

        return $catalogDTO;
    }

    private function buildTree(int $depth): array
    {
        if ($depth <= 0) {
            return [];
        }

        $parents = $this->categoryRepository->findSuperParents();

        return $this->addCategories($parents, $depth, 1);

    }

    private function addCategories($categories, $depth, $currentDepth): array
    {
        $tree = [];

        foreach ($categories as $category) {
            $categoryName = $category->getName();
            $tmp = [$categoryName];

            if ($currentDepth < $depth) {
                $children = $category->getChildren();
                $tmp[$categoryName] = $this->addCategories($children, $depth, $currentDepth);
            }

            $tree[] = $tmp;
        }

        return $tree;
    }
}