<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615124924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_partners ADD created_by_id_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE cdb_partners ADD CONSTRAINT FK_362449CA555BB088 FOREIGN KEY (created_by_id_id) REFERENCES cdb_users (id)');
        $this->addSql('CREATE INDEX IDX_362449CA555BB088 ON cdb_partners (created_by_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_partners DROP FOREIGN KEY FK_362449CA555BB088');
        $this->addSql('DROP INDEX IDX_362449CA555BB088 ON cdb_partners');
        $this->addSql('ALTER TABLE cdb_partners DROP created_by_id_id, DROP created_at');
    }
}
