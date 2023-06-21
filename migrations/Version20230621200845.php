<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621200845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_recipes ADD created_by_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cdb_recipes ADD CONSTRAINT FK_BA2B905CB03A8386 FOREIGN KEY (created_by_id) REFERENCES cdb_users (id)');
        $this->addSql('CREATE INDEX IDX_BA2B905CB03A8386 ON cdb_recipes (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_recipes DROP FOREIGN KEY FK_BA2B905CB03A8386');
        $this->addSql('DROP INDEX IDX_BA2B905CB03A8386 ON cdb_recipes');
        $this->addSql('ALTER TABLE cdb_recipes DROP created_by_id, DROP created_at, DROP image');
    }
}
