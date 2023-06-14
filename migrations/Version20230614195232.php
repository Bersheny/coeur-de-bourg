<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230614195232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cdb_users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, role JSON NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E416B294E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_contact (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, start_date_time DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', end_date_time DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_partners (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, website_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, role JSON NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BAE7EFF6E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cdb_users');
        $this->addSql('DROP TABLE tbl_contact');
        $this->addSql('DROP TABLE tbl_news');
        $this->addSql('DROP TABLE tbl_partners');
        $this->addSql('DROP TABLE tbl_users');
    }
}
