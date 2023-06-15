<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615124816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_news ADD created_by_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cdb_news ADD CONSTRAINT FK_8757A0C0555BB088 FOREIGN KEY (created_by_id_id) REFERENCES cdb_users (id)');
        $this->addSql('CREATE INDEX IDX_8757A0C0555BB088 ON cdb_news (created_by_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_news DROP FOREIGN KEY FK_8757A0C0555BB088');
        $this->addSql('DROP INDEX IDX_8757A0C0555BB088 ON cdb_news');
        $this->addSql('ALTER TABLE cdb_news DROP created_by_id_id');
    }
}
