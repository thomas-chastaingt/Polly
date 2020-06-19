<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618194615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll_option DROP FOREIGN KEY FK_B68343EB3ADB05F1');
        $this->addSql('ALTER TABLE poll_option ADD question_id INT NOT NULL');
        $this->addSql('ALTER TABLE poll_option ADD CONSTRAINT FK_B68343EB1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE poll_option ADD CONSTRAINT FK_B68343EB3ADB05F1 FOREIGN KEY (options_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_B68343EB1E27F6BF ON poll_option (question_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll_option DROP FOREIGN KEY FK_B68343EB1E27F6BF');
        $this->addSql('ALTER TABLE poll_option DROP FOREIGN KEY FK_B68343EB3ADB05F1');
        $this->addSql('DROP INDEX IDX_B68343EB1E27F6BF ON poll_option');
        $this->addSql('ALTER TABLE poll_option DROP question_id');
        $this->addSql('ALTER TABLE poll_option ADD CONSTRAINT FK_B68343EB3ADB05F1 FOREIGN KEY (options_id) REFERENCES question (id)');
    }
}
