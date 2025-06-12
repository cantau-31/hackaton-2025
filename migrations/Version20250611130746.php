<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250611130746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE planning_personnel (planning_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_EEC29DD3D865311 (planning_id), INDEX IDX_EEC29DD1C109075 (personnel_id), PRIMARY KEY(planning_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planning_personnel ADD CONSTRAINT FK_EEC29DD3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planning_personnel ADD CONSTRAINT FK_EEC29DD1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF61C109075
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_D499BFF61C109075 ON planning
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planning DROP personnel_id, CHANGE chantier_id chantier_id INT NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE planning_personnel DROP FOREIGN KEY FK_EEC29DD3D865311
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planning_personnel DROP FOREIGN KEY FK_EEC29DD1C109075
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE planning_personnel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planning ADD personnel_id INT DEFAULT NULL, CHANGE chantier_id chantier_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planning ADD CONSTRAINT FK_D499BFF61C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D499BFF61C109075 ON planning (personnel_id)
        SQL);
    }
}
