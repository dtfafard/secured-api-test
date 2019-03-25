<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190323033758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, status SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, type_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, ip VARCHAR(100) NOT NULL, INDEX IDX_5A6DD5F64584665A (product_id), INDEX IDX_5A6DD5F6C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, status SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F6C54C8C93 FOREIGN KEY (type_id) REFERENCES server_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F64584665A');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F6C54C8C93');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP TABLE server_type');
        $this->addSql('DROP TABLE user');
    }
}
