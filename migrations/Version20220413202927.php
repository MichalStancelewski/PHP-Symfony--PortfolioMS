<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413202927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE project ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE project ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE technology ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE technology ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE technology ALTER description TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project ALTER description TYPE VARCHAR(1500)');
        $this->addSql('ALTER TABLE project ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE technology ALTER description TYPE VARCHAR(500)');
        $this->addSql('ALTER TABLE technology ALTER description DROP DEFAULT');
    }
}
