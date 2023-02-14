<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213142838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cpchemin (id INT AUTO_INCREMENT NOT NULL, nom_cpchemin VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cputilisateur ADD cpchemin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cputilisateur ADD CONSTRAINT FK_EE9CA3B9892734CA FOREIGN KEY (cpchemin_id) REFERENCES cpchemin (id)');
        $this->addSql('CREATE INDEX IDX_EE9CA3B9892734CA ON cputilisateur (cpchemin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cputilisateur DROP FOREIGN KEY FK_EE9CA3B9892734CA');
        $this->addSql('DROP TABLE cpchemin');
        $this->addSql('DROP INDEX IDX_EE9CA3B9892734CA ON cputilisateur');
        $this->addSql('ALTER TABLE cputilisateur DROP cpchemin_id');
    }
}
