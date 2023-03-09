<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220222702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task CHANGE timestamp timestamp VARCHAR(255) DEFAULT NULL, CHANGE last_edit_timestamp last_edit_timestamp VARCHAR(255) DEFAULT NULL, CHANGE created_at_timestamp created_at_timestamp VARCHAR(255) DEFAULT NULL, CHANGE locked_at_timestamp locked_at_timestamp VARCHAR(255) DEFAULT NULL, CHANGE db_created_at_timestamp db_created_at_timestamp VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task CHANGE timestamp timestamp DATETIME DEFAULT NULL, CHANGE last_edit_timestamp last_edit_timestamp DATETIME DEFAULT NULL, CHANGE created_at_timestamp created_at_timestamp DATETIME DEFAULT NULL, CHANGE locked_at_timestamp locked_at_timestamp DATETIME DEFAULT NULL, CHANGE db_created_at_timestamp db_created_at_timestamp DATETIME DEFAULT NULL');
    }
}
