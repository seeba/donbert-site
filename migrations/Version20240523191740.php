<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523191740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_attributes (product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', attributte_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_A2FCC15B4584665A (product_id), INDEX IDX_A2FCC15B925DF678 (attributte_id), PRIMARY KEY(product_id, attributte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attributes ADD CONSTRAINT FK_A2FCC15B4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_attributes ADD CONSTRAINT FK_A2FCC15B925DF678 FOREIGN KEY (attributte_id) REFERENCES attributes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_attributes DROP FOREIGN KEY FK_A2FCC15B4584665A');
        $this->addSql('ALTER TABLE product_attributes DROP FOREIGN KEY FK_A2FCC15B925DF678');
        $this->addSql('DROP TABLE product_attributes');
    }
}
