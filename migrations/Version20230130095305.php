<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130095305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, nom_modele VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet ADD modele_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38AC14B70A ON objet (modele_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38AC14B70A');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP INDEX IDX_46CD4C38AC14B70A ON objet');
        $this->addSql('ALTER TABLE objet DROP modele_id');
    }
}
