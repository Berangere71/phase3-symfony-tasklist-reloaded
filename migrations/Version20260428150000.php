<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260428150000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update task status from "en attente" to "à faire"';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE task SET status = 'à faire' WHERE status = 'en attente'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("UPDATE task SET status = 'en attente' WHERE status = 'à faire'");
    }
}
