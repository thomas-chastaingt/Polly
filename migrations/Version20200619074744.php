<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619074744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departments (id INT AUTO_INCREMENT NOT NULL, country_id_id INT NOT NULL, code INT NOT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_16AEB8D4D8A48BBD (country_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departments ADD CONSTRAINT FK_16AEB8D4D8A48BBD FOREIGN KEY (country_id_id) REFERENCES countries (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE departments');
    }
}
