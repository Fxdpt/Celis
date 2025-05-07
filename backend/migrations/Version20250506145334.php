<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotionLabelEnum;
use App\Emotion\Domain\Model\SecondaryEmotion\SecondaryEmotionLabelEnum;
use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotionLabelEnum;
use App\Emotion\Infrastructure\EnumConverter\PrimaryEmotionLabelConverter;
use App\Emotion\Infrastructure\EnumConverter\SecondaryEmotionLabelConverter;
use App\Emotion\Infrastructure\EnumConverter\TertiaryEmotionLabelConverter;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250506145334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE emotion_log (
                id INT AUTO_INCREMENT NOT NULL,
                primary_emotion_id INT NOT NULL,
                secondary_emotion_id INT NOT NULL,
                tertiary_emotion_id INT NOT NULL,
                date INT NOT NULL,
                comment LONGTEXT DEFAULT NULL,
                INDEX IDX_E74306FF204049E4 (primary_emotion_id),
                INDEX IDX_E74306FF37A2485F (secondary_emotion_id),
                INDEX IDX_E74306FFA3BDC749 (tertiary_emotion_id),
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE primary_emotion (
                id INT AUTO_INCREMENT NOT NULL,
                emotion_label VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE secondary_emotion (
                id INT AUTO_INCREMENT NOT NULL,
                emotion_label VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tertiary_emotion (
                id INT AUTO_INCREMENT NOT NULL,
                emotion_label VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log ADD CONSTRAINT FK_E74306FF204049E4 FOREIGN KEY (primary_emotion_id) REFERENCES primary_emotion (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log ADD CONSTRAINT FK_E74306FF37A2485F FOREIGN KEY (secondary_emotion_id) REFERENCES secondary_emotion (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log ADD CONSTRAINT FK_E74306FFA3BDC749 FOREIGN KEY (tertiary_emotion_id) REFERENCES tertiary_emotion (id)
        SQL);

        $values = array_map(
            fn($case) => sprintf("('%s')", PrimaryEmotionLabelConverter::toString($case)),
            PrimaryEmotionLabelEnum::cases()
        );
        $primaryEmotionQueryString = implode(', ', $values);
        $this->addSql(<<<SQL
            INSERT INTO primary_emotion (emotion_label) VALUES $primaryEmotionQueryString
        SQL);

        $values = array_map(
            fn($case) => sprintf("('%s')", SecondaryEmotionLabelConverter::toString($case)),
            SecondaryEmotionLabelEnum::cases()
        );
        $secondaryEmotionQueryString = implode(', ', $values);
        $this->addSql(<<<SQL
            INSERT INTO secondary_emotion (emotion_label) VALUES $secondaryEmotionQueryString
        SQL);

        $values = array_map(
            fn($case) => sprintf("('%s')", TertiaryEmotionLabelConverter::toString($case)),
            TertiaryEmotionLabelEnum::cases()
        );
        $tertiaryEmotionQueryString = implode(', ', $values);
        $this->addSql(<<<SQL
            INSERT INTO tertiary_emotion (emotion_label) VALUES $tertiaryEmotionQueryString
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log DROP FOREIGN KEY FK_E74306FF204049E4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log DROP FOREIGN KEY FK_E74306FF37A2485F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emotion_log DROP FOREIGN KEY FK_E74306FFA3BDC749
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE emotion_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE primary_emotion
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE secondary_emotion
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tertiary_emotion
        SQL);
    }
}
