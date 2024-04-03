<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240402221536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connected_device ADD timer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE connected_device ADD CONSTRAINT FK_F097D203EE98D9B9 FOREIGN KEY (timer_id) REFERENCES timer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F097D203EE98D9B9 ON connected_device (timer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connected_device DROP FOREIGN KEY FK_F097D203EE98D9B9');
        $this->addSql('DROP INDEX UNIQ_F097D203EE98D9B9 ON connected_device');
        $this->addSql('ALTER TABLE connected_device DROP timer_id');
    }
}
