<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230614195135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cdb_partners (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, website_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_contact (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cdb_users CHANGE role role JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E416B294E7927C74 ON cdb_users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cdb_partners');
        $this->addSql('DROP TABLE tbl_contact');
        $this->addSql('DROP INDEX UNIQ_E416B294E7927C74 ON cdb_users');
        $this->addSql('ALTER TABLE cdb_users CHANGE role role LONGTEXT NOT NULL');
    }
}
