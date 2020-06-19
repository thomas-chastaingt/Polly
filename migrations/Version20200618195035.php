<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618195035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers_question (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, options_id INT NOT NULL, department_id INT NOT NULL, INDEX IDX_F0A930A61E27F6BF (question_id), INDEX IDX_F0A930A63ADB05F1 (options_id), INDEX IDX_F0A930A6AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll_answer (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers_question ADD CONSTRAINT FK_F0A930A61E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answers_question ADD CONSTRAINT FK_F0A930A63ADB05F1 FOREIGN KEY (options_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE answers_question ADD CONSTRAINT FK_F0A930A6AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE answers_question');
        $this->addSql('DROP TABLE poll_answer');
    }
}
