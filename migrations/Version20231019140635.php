<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231019140635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_880e0d768d93d649');
        $this->addSql('ALTER TABLE admin RENAME COLUMN "user" TO useradmin');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76AFAA31A4 ON admin (useradmin)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_880E0D76AFAA31A4');
        $this->addSql('ALTER TABLE admin RENAME COLUMN useradmin TO "user"');
        $this->addSql('CREATE UNIQUE INDEX uniq_880e0d768d93d649 ON admin ("user")');
    }
}
