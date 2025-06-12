<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250611134325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE planning DROP personnel_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD personnel_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D6491C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8D93D6491C109075 ON user (personnel_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE planning ADD personnel_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491C109075
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_8D93D6491C109075 ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP personnel_id
        SQL);
    }
}
