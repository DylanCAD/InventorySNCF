<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130090142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appareil (id INT AUTO_INCREMENT NOT NULL, genre_appareil VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet ADD appareil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38BF6A0032 FOREIGN KEY (appareil_id) REFERENCES appareil (id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38BF6A0032 ON objet (appareil_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38BF6A0032');
        $this->addSql('DROP TABLE appareil');
        $this->addSql('DROP INDEX IDX_46CD4C38BF6A0032 ON objet');
        $this->addSql('ALTER TABLE objet DROP appareil_id');
    }
}
