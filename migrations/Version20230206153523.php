<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206153523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, nom_admin VARCHAR(255) NOT NULL, prenom_admin VARCHAR(255) NOT NULL, mdp_admin VARCHAR(255) NOT NULL, fonction_admin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appareil (id INT AUTO_INCREMENT NOT NULL, genre_appareil VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cputilisateur (id INT AUTO_INCREMENT NOT NULL, nom_cputilisateur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, cathegorie_inventaire VARCHAR(255) NOT NULL, INDEX IDX_338920E0FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom_marque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, nom_modele VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objet (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, admin_id INT DEFAULT NULL, inventaire_id INT DEFAULT NULL, appareil_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, modele_id INT DEFAULT NULL, libelle_objet VARCHAR(255) NOT NULL, last_modif_objet DATE NOT NULL, quantite_objet INT NOT NULL, num_serie_objet VARCHAR(255) DEFAULT NULL, INDEX IDX_46CD4C38FB88E14F (utilisateur_id), INDEX IDX_46CD4C38642B8210 (admin_id), INDEX IDX_46CD4C38CE430A85 (inventaire_id), INDEX IDX_46CD4C38BF6A0032 (appareil_id), INDEX IDX_46CD4C384827B9B2 (marque_id), INDEX IDX_46CD4C38AC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tel (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, admin_id INT DEFAULT NULL, inventaire_id INT DEFAULT NULL, appareil_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, modele_id INT DEFAULT NULL, cputilisateur_id INT DEFAULT NULL, libelle_tel VARCHAR(255) NOT NULL, last_modif_tel DATE NOT NULL, quantite_tel INT NOT NULL, num_serie VARCHAR(255) DEFAULT NULL, INDEX IDX_F037AB0FFB88E14F (utilisateur_id), INDEX IDX_F037AB0F642B8210 (admin_id), INDEX IDX_F037AB0FCE430A85 (inventaire_id), INDEX IDX_F037AB0FBF6A0032 (appareil_id), INDEX IDX_F037AB0F4827B9B2 (marque_id), INDEX IDX_F037AB0FAC14B70A (modele_id), INDEX IDX_F037AB0FD05D3004 (cputilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, prenom_utilisateur VARCHAR(255) NOT NULL, fonction_utilisateur VARCHAR(255) NOT NULL, mdp_utilisateur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E0FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38BF6A0032 FOREIGN KEY (appareil_id) REFERENCES appareil (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C384827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0F642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FCE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FBF6A0032 FOREIGN KEY (appareil_id) REFERENCES appareil (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0F4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FD05D3004 FOREIGN KEY (cputilisateur_id) REFERENCES cputilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E0FB88E14F');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38FB88E14F');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38642B8210');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38CE430A85');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38BF6A0032');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C384827B9B2');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38AC14B70A');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FFB88E14F');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0F642B8210');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FCE430A85');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FBF6A0032');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0F4827B9B2');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FAC14B70A');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FD05D3004');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE appareil');
        $this->addSql('DROP TABLE cputilisateur');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE objet');
        $this->addSql('DROP TABLE tel');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
