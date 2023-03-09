<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220155506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, task_id INT NOT NULL, external_id INT NOT NULL, name VARCHAR(255) NOT NULL, timestamp DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, driver_name VARCHAR(255) NOT NULL, driver_email VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, customer VARCHAR(255) DEFAULT NULL, customer_external_id INT DEFAULT NULL, customer_name VARCHAR(255) DEFAULT NULL, last_edit_timestamp DATETIME NOT NULL, created_at_timestamp DATETIME DEFAULT NULL, locked_at_timestamp DATETIME DEFAULT NULL, db_created_at_timestamp DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE task');
    }
}
