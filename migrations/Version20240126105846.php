<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240126105846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pending_contact (id INT AUTO_INCREMENT NOT NULL, announce_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date_contact DATE NOT NULL, UNIQUE INDEX UNIQ_870D11A96F5DA3DE (announce_id), UNIQUE INDEX UNIQ_870D11A9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pending_contact ADD CONSTRAINT FK_870D11A96F5DA3DE FOREIGN KEY (announce_id) REFERENCES announce (id)');
        $this->addSql('ALTER TABLE pending_contact ADD CONSTRAINT FK_870D11A9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pending_contact DROP FOREIGN KEY FK_870D11A96F5DA3DE');
        $this->addSql('ALTER TABLE pending_contact DROP FOREIGN KEY FK_870D11A9A76ED395');
        $this->addSql('DROP TABLE pending_contact');
    }
}
