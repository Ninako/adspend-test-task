<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220922022934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Client';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, parent_id INT DEFAULT NULL)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_5099753919EB6921 FOREIGN KEY (parent_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        foreach ($this->categories as $category) {
            [$categoryId, $name, $parentId] = $category;
            $this->addSql(
                'INSERT INTO category (id, name, parent_id) VALUES (:categoryId, :name, :parent_id)',
                compact('categoryId', 'name', 'parentId')
            );
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE category');
    }

    private array $categories = [
        [1, 'Транспорт', null],
        [2, 'Автомобили', 1],
        [3, 'Легковые', 2],
        [4, 'Грузовые', 2],
        [5, 'Внедорожник', 2],

        [6, 'Мототехника', null],
        [7, 'Мотоциклы', 6],
        [8, 'Кросовые', 7],
        [9, 'Шоссейные', 7],
        [10, 'Скутеры', 6],
        [11, 'Эл.самокаты', 6],

        [12, 'Велосипеды', null],
        [13, 'Горные', 12],
        [14, 'Профессиональные', 13],
        [15, 'Лето', 14],
        [16, 'Зима', 14],
        [17, 'Любительские', 13],
        [18, 'Шоссейные', 12],
        [19, 'Профессиональные', 18],
        [20, 'Лето', 19],
        [21, 'Зима', 19],
        [22, 'Любительские', 18]
    ];
}
