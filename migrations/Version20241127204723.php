<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241127204723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subscription ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP roles, DROP reset_token');
        $this->addSql('ALTER TABLE subscription DROP description');
    }
}
