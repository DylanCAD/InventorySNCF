<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117170816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76F520CF5A');
        $this->addSql('DROP INDEX IDX_880E0D76F520CF5A ON admin');
        $this->addSql('ALTER TABLE admin DROP objet_id');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E0F520CF5A');
        $this->addSql('DROP INDEX IDX_338920E0F520CF5A ON inventaire');
        $this->addSql('ALTER TABLE inventaire CHANGE objet_id utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E0FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_338920E0FB88E14F ON inventaire (utilisateur_id)');
        $this->addSql('ALTER TABLE objet ADD utilisateur_id INT DEFAULT NULL, ADD admin_id INT NOT NULL, ADD inventaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38FB88E14F ON objet (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38642B8210 ON objet (admin_id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38CE430A85 ON objet (inventaire_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3DF6E65AD');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3CE430A85');
        $this->addSql('DROP INDEX IDX_1D1C63B3CE430A85 ON utilisateur');
        $this->addSql('DROP INDEX IDX_1D1C63B3DF6E65AD ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP admin_id_id, DROP inventaire_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD objet_id INT NOT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id)');
        $this->addSql('CREATE INDEX IDX_880E0D76F520CF5A ON admin (objet_id)');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E0FB88E14F');
        $this->addSql('DROP INDEX IDX_338920E0FB88E14F ON inventaire');
        $this->addSql('ALTER TABLE inventaire CHANGE utilisateur_id objet_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E0F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id)');
        $this->addSql('CREATE INDEX IDX_338920E0F520CF5A ON inventaire (objet_id)');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38FB88E14F');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38642B8210');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38CE430A85');
        $this->addSql('DROP INDEX IDX_46CD4C38FB88E14F ON objet');
        $this->addSql('DROP INDEX IDX_46CD4C38642B8210 ON objet');
        $this->addSql('DROP INDEX IDX_46CD4C38CE430A85 ON objet');
        $this->addSql('ALTER TABLE objet DROP utilisateur_id, DROP admin_id, DROP inventaire_id');
        $this->addSql('ALTER TABLE utilisateur ADD admin_id_id INT NOT NULL, ADD inventaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3DF6E65AD FOREIGN KEY (admin_id_id) REFERENCES objet (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3CE430A85 ON utilisateur (inventaire_id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3DF6E65AD ON utilisateur (admin_id_id)');
    }
}
