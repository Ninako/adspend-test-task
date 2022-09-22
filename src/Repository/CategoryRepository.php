<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass = Category::class)
    {
        parent::__construct($registry, $entityClass);
    }

    public function findSuperParents(): array
    {
        return $this->createQueryBuilder('category')
            ->where('category.deletedAt IS NULL')
            ->andWhere('category.parent_id IS NULL')
            ->getQuery()
            ->getResult()
            ;
    }
}
