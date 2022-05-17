<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210231112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_activity (user_id INTEGER NOT NULL, activity_id INTEGER NOT NULL, PRIMARY KEY(user_id, activity_id))');
        $this->addSql('CREATE INDEX IDX_4CF9ED5AA76ED395 ON user_activity (user_id)');
        $this->addSql('CREATE INDEX IDX_4CF9ED5A81C06096 ON user_activity (activity_id)');
        $this->addSql('DROP INDEX IDX_AC74095AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__activity AS SELECT id, user_id, name, description FROM activity');
        $this->addSql('DROP TABLE activity');
        $this->addSql('CREATE TABLE activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, CONSTRAINT FK_AC74095AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO activity (id, user_id, name, description) SELECT id, user_id, name, description FROM __temp__activity');
        $this->addSql('DROP TABLE __temp__activity');
        $this->addSql('CREATE INDEX IDX_AC74095AA76ED395 ON activity (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_activity');
        $this->addSql('DROP INDEX IDX_AC74095AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__activity AS SELECT id, user_id, name, description FROM activity');
        $this->addSql('DROP TABLE activity');
        $this->addSql('CREATE TABLE activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO activity (id, user_id, name, description) SELECT id, user_id, name, description FROM __temp__activity');
        $this->addSql('DROP TABLE __temp__activity');
        $this->addSql('CREATE INDEX IDX_AC74095AA76ED395 ON activity (user_id)');
    }
}
