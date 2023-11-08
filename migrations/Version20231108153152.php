<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108153152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE renouvellement (id INT IDENTITY NOT NULL, nom NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE reservation ADD renouvellement_id INT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552D421B0 FOREIGN KEY (renouvellement_id) REFERENCES renouvellement (id)');
        $this->addSql('CREATE INDEX IDX_42C849552D421B0 ON reservation (renouvellement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849552D421B0');
        $this->addSql('DROP TABLE renouvellement');
        $this->addSql('DROP INDEX IDX_42C849552D421B0 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP COLUMN renouvellement_id');
    }
}
