<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240402221440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timer DROP FOREIGN KEY FK_6AD0DE1AB962DAE3');
        $this->addSql('DROP INDEX IDX_6AD0DE1AB962DAE3 ON timer');
        $this->addSql('ALTER TABLE timer DROP connected_device_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timer ADD connected_device_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE timer ADD CONSTRAINT FK_6AD0DE1AB962DAE3 FOREIGN KEY (connected_device_id) REFERENCES connected_device (id)');
        $this->addSql('CREATE INDEX IDX_6AD0DE1AB962DAE3 ON timer (connected_device_id)');
    }
}
