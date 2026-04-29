<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260428075525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE priority ADD COLUMN bg_color VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE priority ADD COLUMN text_color VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__priority AS SELECT id, name, importance FROM priority');
        $this->addSql('DROP TABLE priority');
        $this->addSql('CREATE TABLE priority (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, importance INTEGER NOT NULL)');
        $this->addSql('INSERT INTO priority (id, name, importance) SELECT id, name, importance FROM __temp__priority');
        $this->addSql('DROP TABLE __temp__priority');
    }
}
