<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201104949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, number INT NOT NULL, synopsis LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, episode_id INT NOT NULL, number INT NOT NULL, year INT NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_F0E45BA9362B62A0 (episode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id)');
        $this->addSql('ALTER TABLE program ADD season_id INT NOT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED77844EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_92ED77844EC001D1 ON program (season_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED77844EC001D1');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9362B62A0');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP INDEX IDX_92ED77844EC001D1 ON program');
        $this->addSql('ALTER TABLE program DROP season_id');
    }
}
