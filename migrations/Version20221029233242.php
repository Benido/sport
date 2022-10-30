<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221029233242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP structures, DROP branch');
        $this->addSql('ALTER TABLE client DROP structures, DROP branch');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD structures LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD branch LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE client ADD structures LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD branch LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
