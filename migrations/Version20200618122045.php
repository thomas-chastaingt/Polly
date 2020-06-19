<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618122045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EF92F3E70 ON question (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EF92F3E70');
        $this->addSql('DROP INDEX IDX_B6F7494EF92F3E70 ON question');
        $this->addSql('ALTER TABLE question DROP country_id');
    }
}
