<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130101147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tel ADD appareil_id INT DEFAULT NULL, ADD marque_id INT DEFAULT NULL, ADD modele_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FBF6A0032 FOREIGN KEY (appareil_id) REFERENCES appareil (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0F4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_F037AB0FBF6A0032 ON tel (appareil_id)');
        $this->addSql('CREATE INDEX IDX_F037AB0F4827B9B2 ON tel (marque_id)');
        $this->addSql('CREATE INDEX IDX_F037AB0FAC14B70A ON tel (modele_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FBF6A0032');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0F4827B9B2');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FAC14B70A');
        $this->addSql('DROP INDEX IDX_F037AB0FBF6A0032 ON tel');
        $this->addSql('DROP INDEX IDX_F037AB0F4827B9B2 ON tel');
        $this->addSql('DROP INDEX IDX_F037AB0FAC14B70A ON tel');
        $this->addSql('ALTER TABLE tel DROP appareil_id, DROP marque_id, DROP modele_id');
    }
}
