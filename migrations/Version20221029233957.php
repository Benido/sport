<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221029233957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partenaire ADD client_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA37319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_32FFA37319EB6921 ON partenaire (client_id)');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA19EB6921');
        $this->addSql('DROP INDEX IDX_6F0137EA19EB6921 ON structure');
        $this->addSql('ALTER TABLE structure DROP client_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA37319EB6921');
        $this->addSql('DROP INDEX IDX_32FFA37319EB6921 ON partenaire');
        $this->addSql('ALTER TABLE partenaire DROP client_id');
        $this->addSql('ALTER TABLE structure ADD client_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_6F0137EA19EB6921 ON structure (client_id)');
    }
}
