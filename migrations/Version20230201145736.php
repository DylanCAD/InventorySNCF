<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201145736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribution ADD tel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED49985342D0 FOREIGN KEY (tel_id) REFERENCES tel (id)');
        $this->addSql('CREATE INDEX IDX_C751ED49985342D0 ON attribution (tel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribution DROP FOREIGN KEY FK_C751ED49985342D0');
        $this->addSql('DROP INDEX IDX_C751ED49985342D0 ON attribution');
        $this->addSql('ALTER TABLE attribution DROP tel_id');
    }
}
