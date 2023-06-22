<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622140706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cdb_recipes_featured (id INT AUTO_INCREMENT NOT NULL, featured_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_DFDE4752306FF23 (featured_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cdb_recipes_featured ADD CONSTRAINT FK_DFDE4752306FF23 FOREIGN KEY (featured_id) REFERENCES cdb_recipes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdb_recipes_featured DROP FOREIGN KEY FK_DFDE4752306FF23');
        $this->addSql('DROP TABLE cdb_recipes_featured');
    }
}
