<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124094858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tel (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, admin_id INT DEFAULT NULL, inventaire_id INT DEFAULT NULL, libelle_tel VARCHAR(255) NOT NULL, last_modif_tel DATE NOT NULL, quantite_tel INT NOT NULL, INDEX IDX_F037AB0FFB88E14F (utilisateur_id), INDEX IDX_F037AB0F642B8210 (admin_id), INDEX IDX_F037AB0FCE430A85 (inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0F642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FCE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FFB88E14F');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0F642B8210');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FCE430A85');
        $this->addSql('DROP TABLE tel');
    }
}
