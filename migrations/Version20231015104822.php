<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231015104822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE promotion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE promotion (id INT NOT NULL, product_id_id INT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, pourcentage_remise INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C11D7DD1DE18E50B ON promotion (product_id_id)');
        $this->addSql('COMMENT ON COLUMN promotion.date_debut IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN promotion.date_fin IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE promotion_id_seq CASCADE');
        $this->addSql('ALTER TABLE promotion DROP CONSTRAINT FK_C11D7DD1DE18E50B');
        $this->addSql('DROP TABLE promotion');
    }
}
