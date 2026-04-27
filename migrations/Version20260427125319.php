<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260427125319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__folder AS SELECT id, name FROM folder');
        $this->addSql('DROP TABLE folder');
        $this->addSql('CREATE TABLE folder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(7) DEFAULT NULL)');
        $this->addSql('INSERT INTO folder (id, name) SELECT id, name FROM __temp__folder');
        $this->addSql('DROP TABLE __temp__folder');
        $this->addSql('CREATE TEMPORARY TABLE __temp__priority AS SELECT id, name, importance FROM priority');
        $this->addSql('DROP TABLE priority');
        $this->addSql('CREATE TABLE priority (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, importance INTEGER NOT NULL)');
        $this->addSql('INSERT INTO priority (id, name, importance) SELECT id, name, importance FROM __temp__priority');
        $this->addSql('DROP TABLE __temp__priority');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, username FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, username) SELECT id, email, roles, password, username FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__folder AS SELECT id, name FROM folder');
        $this->addSql('DROP TABLE folder');
        $this->addSql('CREATE TABLE folder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO folder (id, name) SELECT id, name FROM __temp__folder');
        $this->addSql('DROP TABLE __temp__folder');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECA209CD5E237E06 ON folder (name)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__priority AS SELECT id, name, importance FROM priority');
        $this->addSql('DROP TABLE priority');
        $this->addSql('CREATE TABLE priority (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, importance INTEGER NOT NULL)');
        $this->addSql('INSERT INTO priority (id, name, importance) SELECT id, name, importance FROM __temp__priority');
        $this->addSql('DROP TABLE __temp__priority');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62A6DC274A99BD99 ON priority (importance)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62A6DC275E237E06 ON priority (name)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, username FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, username) SELECT id, email, roles, password, username FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
