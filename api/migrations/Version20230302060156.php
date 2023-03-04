<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230302060156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE fruit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nutrition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fruit (id INT NOT NULL, nutrition_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, genus VARCHAR(255) DEFAULT NULL, family VARCHAR(255) DEFAULT NULL, fruit_order VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A00BD297B5D724CD ON fruit (nutrition_id)');
        $this->addSql('CREATE TABLE nutrition (id INT NOT NULL, carbohydrates DOUBLE PRECISION NOT NULL, protein DOUBLE PRECISION NOT NULL, fat DOUBLE PRECISION NOT NULL, calories DOUBLE PRECISION NOT NULL, sugar DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE fruit ADD CONSTRAINT FK_A00BD297B5D724CD FOREIGN KEY (nutrition_id) REFERENCES nutrition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE fruit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nutrition_id_seq CASCADE');
        $this->addSql('ALTER TABLE fruit DROP CONSTRAINT FK_A00BD297B5D724CD');
        $this->addSql('DROP TABLE fruit');
        $this->addSql('DROP TABLE nutrition');
    }
}
