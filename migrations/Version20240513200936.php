<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513200936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantity_per_roll_attribute (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thickness_attribute (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', thickness DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quantity_per_roll_attribute ADD CONSTRAINT FK_3B062126BF396750 FOREIGN KEY (id) REFERENCES attributes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE thickness_attribute ADD CONSTRAINT FK_11C6F8DEBF396750 FOREIGN KEY (id) REFERENCES attributes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_per_roll_attribute DROP FOREIGN KEY FK_3B062126BF396750');
        $this->addSql('ALTER TABLE thickness_attribute DROP FOREIGN KEY FK_11C6F8DEBF396750');
        $this->addSql('DROP TABLE quantity_per_roll_attribute');
        $this->addSql('DROP TABLE thickness_attribute');
    }
}
