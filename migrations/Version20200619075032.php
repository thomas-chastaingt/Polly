<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619075032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE poll_answers (id INT AUTO_INCREMENT NOT NULL, poll_id_id INT NOT NULL, option_id_id INT NOT NULL, department_id_id INT NOT NULL, INDEX IDX_AC854B3919F5E396 (poll_id_id), INDEX IDX_AC854B3946AF233F (option_id_id), INDEX IDX_AC854B3964E7214B (department_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poll_answers ADD CONSTRAINT FK_AC854B3919F5E396 FOREIGN KEY (poll_id_id) REFERENCES polls (id)');
        $this->addSql('ALTER TABLE poll_answers ADD CONSTRAINT FK_AC854B3946AF233F FOREIGN KEY (option_id_id) REFERENCES options (id)');
        $this->addSql('ALTER TABLE poll_answers ADD CONSTRAINT FK_AC854B3964E7214B FOREIGN KEY (department_id_id) REFERENCES departments (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE poll_answers');
    }
}
