<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102104412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT IDENTITY NOT NULL, nom NVARCHAR(255) NOT NULL, prix INT NOT NULL, nbr_emplacement INT NOT NULL, reduction INT NOT NULL, img_path NVARCHAR(255), PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE baie (id INT IDENTITY NOT NULL, nbr_emplacement INT NOT NULL, status BIT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE reservation (id INT IDENTITY NOT NULL, identifiant_abonnement_id INT, date_deb DATETIME2(6) NOT NULL, date_end DATETIME2(6) NOT NULL, ren_auto BIT NOT NULL, quantity INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_42C8495525ABD6B9 ON reservation (identifiant_abonnement_id)');
        $this->addSql('CREATE TABLE type_unite (id INT IDENTITY NOT NULL, nom NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE unite (id INT IDENTITY NOT NULL, identifiant_type_unite_id INT, identifiant_baie_id INT, identifiant_reservation_id INT, numero INT NOT NULL, status BIT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_1D64C118F5C9C1FD ON unite (identifiant_type_unite_id)');
        $this->addSql('CREATE INDEX IDX_1D64C11890C0C5E ON unite (identifiant_baie_id)');
        $this->addSql('CREATE INDEX IDX_1D64C1188EE5A183 ON unite (identifiant_reservation_id)');
        $this->addSql('CREATE TABLE [user] (id INT IDENTITY NOT NULL, email NVARCHAR(180) NOT NULL, roles VARCHAR(MAX) NOT NULL, password NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON [user] (email) WHERE email IS NOT NULL');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:json)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'user\', N\'COLUMN\', roles');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT IDENTITY NOT NULL, body VARCHAR(MAX) NOT NULL, headers VARCHAR(MAX) NOT NULL, queue_name NVARCHAR(190) NOT NULL, created_at DATETIME2(6) NOT NULL, available_at DATETIME2(6) NOT NULL, delivered_at DATETIME2(6), PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:datetime_immutable)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'messenger_messages\', N\'COLUMN\', created_at');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:datetime_immutable)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'messenger_messages\', N\'COLUMN\', available_at');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:datetime_immutable)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'messenger_messages\', N\'COLUMN\', delivered_at');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495525ABD6B9 FOREIGN KEY (identifiant_abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C118F5C9C1FD FOREIGN KEY (identifiant_type_unite_id) REFERENCES type_unite (id)');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C11890C0C5E FOREIGN KEY (identifiant_baie_id) REFERENCES baie (id)');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C1188EE5A183 FOREIGN KEY (identifiant_reservation_id) REFERENCES reservation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495525ABD6B9');
        $this->addSql('ALTER TABLE unite DROP CONSTRAINT FK_1D64C118F5C9C1FD');
        $this->addSql('ALTER TABLE unite DROP CONSTRAINT FK_1D64C11890C0C5E');
        $this->addSql('ALTER TABLE unite DROP CONSTRAINT FK_1D64C1188EE5A183');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE baie');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE type_unite');
        $this->addSql('DROP TABLE unite');
        $this->addSql('DROP TABLE [user]');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
