<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622104827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cdb_recipes (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, time_days INT DEFAULT NULL, time_hours INT DEFAULT NULL, time_minutes INT NOT NULL, difficulty VARCHAR(255) NOT NULL, pricing VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', image VARCHAR(255) DEFAULT NULL, INDEX IDX_BA2B905CB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cdb_recipes ADD CONSTRAINT FK_BA2B905CB03A8386 FOREIGN KEY (created_by_id) REFERENCES cdb_users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_recipes DROP FOREIGN KEY FK_BA2B905CB03A8386');
        $this->addSql('DROP TABLE cdb_recipes');
    }
}
