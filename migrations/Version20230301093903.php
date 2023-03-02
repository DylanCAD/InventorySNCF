<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301093903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E0FB88E14F');
        $this->addSql('DROP INDEX IDX_338920E0FB88E14F ON inventaire');
        $this->addSql('ALTER TABLE inventaire DROP utilisateur_id');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38642B8210');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38FB88E14F');
        $this->addSql('DROP INDEX IDX_46CD4C38FB88E14F ON objet');
        $this->addSql('DROP INDEX IDX_46CD4C38642B8210 ON objet');
        $this->addSql('ALTER TABLE objet DROP utilisateur_id, DROP admin_id');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0F642B8210');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FFB88E14F');
        $this->addSql('DROP INDEX IDX_F037AB0FFB88E14F ON tel');
        $this->addSql('DROP INDEX IDX_F037AB0F642B8210 ON tel');
        $this->addSql('ALTER TABLE tel DROP utilisateur_id, DROP admin_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventaire ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E0FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_338920E0FB88E14F ON inventaire (utilisateur_id)');
        $this->addSql('ALTER TABLE objet ADD utilisateur_id INT DEFAULT NULL, ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_46CD4C38FB88E14F ON objet (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38642B8210 ON objet (admin_id)');
        $this->addSql('ALTER TABLE tel ADD utilisateur_id INT DEFAULT NULL, ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0F642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F037AB0FFB88E14F ON tel (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_F037AB0F642B8210 ON tel (admin_id)');
    }
}
