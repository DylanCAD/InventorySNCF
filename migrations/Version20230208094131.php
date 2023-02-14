<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208094131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tel ADD cputilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FD05D3004 FOREIGN KEY (cputilisateur_id) REFERENCES cputilisateur (id)');
        $this->addSql('CREATE INDEX IDX_F037AB0FD05D3004 ON tel (cputilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FD05D3004');
        $this->addSql('DROP INDEX IDX_F037AB0FD05D3004 ON tel');
        $this->addSql('ALTER TABLE tel DROP cputilisateur_id');
    }
}
