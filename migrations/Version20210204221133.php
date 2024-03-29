<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204221133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE traduc_source (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, projects_id INT NOT NULL, project_id INT NOT NULL, source VARCHAR(255) NOT NULL, INDEX IDX_2B9BC44567B3B43D (users_id), INDEX IDX_2B9BC4451EDE0F55 (projects_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE traduc_source ADD CONSTRAINT FK_2B9BC44567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE traduc_source ADD CONSTRAINT FK_2B9BC4451EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE traduc_source');
    }
}
