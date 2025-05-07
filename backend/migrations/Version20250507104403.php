<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507104403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE trigger_event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log ADD trigger_event_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log ADD CONSTRAINT FK_E74306FF2EF62084 FOREIGN KEY (trigger_event_id) REFERENCES trigger_event (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E74306FF2EF62084 ON emotion_log (trigger_event_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log DROP FOREIGN KEY FK_E74306FF2EF62084
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE trigger_event
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E74306FF2EF62084 ON emotion_log
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log DROP trigger_event_id
        SQL);
    }
}
