<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240407132400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalog_item (id INT AUTO_INCREMENT NOT NULL, entity_id INT NOT NULL, category_name VARCHAR(255) NOT NULL, sku VARCHAR(80) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, short_desc LONGTEXT DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, link LONGTEXT DEFAULT NULL, image LONGTEXT DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, rating INT NOT NULL, caffeine_type VARCHAR(80) DEFAULT NULL, count INT DEFAULT NULL, flavored VARCHAR(20) DEFAULT NULL, seasonal VARCHAR(20) DEFAULT NULL, in_stock VARCHAR(20) DEFAULT NULL, facebook VARCHAR(20) DEFAULT NULL, is_k_cup TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE catalog_item');
    }
}
