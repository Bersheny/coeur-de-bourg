<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415143305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cdb_news (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, start_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', end_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8757A0C0B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cdb_partners (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, website_link VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_362449CAB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cdb_recipes (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, time_days INT DEFAULT NULL, time_hours INT DEFAULT NULL, time_minutes INT NOT NULL, difficulty VARCHAR(255) NOT NULL, pricing VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BA2B905CB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cdb_recipes_featured (id INT AUTO_INCREMENT NOT NULL, featured INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cdb_users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, role LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E416B294E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cdb_news ADD CONSTRAINT FK_8757A0C0B03A8386 FOREIGN KEY (created_by_id) REFERENCES cdb_users (id)');
        $this->addSql('ALTER TABLE cdb_partners ADD CONSTRAINT FK_362449CAB03A8386 FOREIGN KEY (created_by_id) REFERENCES cdb_users (id)');
        $this->addSql('ALTER TABLE cdb_recipes ADD CONSTRAINT FK_BA2B905CB03A8386 FOREIGN KEY (created_by_id) REFERENCES cdb_users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_news DROP FOREIGN KEY FK_8757A0C0B03A8386');
        $this->addSql('ALTER TABLE cdb_partners DROP FOREIGN KEY FK_362449CAB03A8386');
        $this->addSql('ALTER TABLE cdb_recipes DROP FOREIGN KEY FK_BA2B905CB03A8386');
        $this->addSql('DROP TABLE cdb_news');
        $this->addSql('DROP TABLE cdb_partners');
        $this->addSql('DROP TABLE cdb_recipes');
        $this->addSql('DROP TABLE cdb_recipes_featured');
        $this->addSql('DROP TABLE cdb_users');
    }
}
