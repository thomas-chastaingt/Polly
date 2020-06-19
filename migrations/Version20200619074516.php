<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619074516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE polls (id INT AUTO_INCREMENT NOT NULL, author_id_id INT NOT NULL, country_id_id INT NOT NULL, title VARCHAR(100) NOT NULL, hide TINYINT(1) NOT NULL, INDEX IDX_1D3CC6EE69CCBE9A (author_id_id), INDEX IDX_1D3CC6EED8A48BBD (country_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE polls ADD CONSTRAINT FK_1D3CC6EE69CCBE9A FOREIGN KEY (author_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE polls ADD CONSTRAINT FK_1D3CC6EED8A48BBD FOREIGN KEY (country_id_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE options ADD polls_id INT NOT NULL');
        $this->addSql('ALTER TABLE options ADD CONSTRAINT FK_D035FA8777F234C8 FOREIGN KEY (polls_id) REFERENCES polls (id)');
        $this->addSql('CREATE INDEX IDX_D035FA8777F234C8 ON options (polls_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE options DROP FOREIGN KEY FK_D035FA8777F234C8');
        $this->addSql('DROP TABLE polls');
        $this->addSql('DROP INDEX IDX_D035FA8777F234C8 ON options');
        $this->addSql('ALTER TABLE options DROP polls_id');
    }
}
