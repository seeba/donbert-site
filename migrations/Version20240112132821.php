<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112132821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attributes (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, attribute_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, INDEX IDX_3AF34668727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color_attribute (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', category_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size_attribute (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', size VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variants (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, INDEX IDX_B39853E14584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variant_attributes (variant_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', attributte_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_C31A62E53B69A9AF (variant_id), INDEX IDX_C31A62E5925DF678 (attributte_id), PRIMARY KEY(variant_id, attributte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE color_attribute ADD CONSTRAINT FK_62744ADCBF396750 FOREIGN KEY (id) REFERENCES attributes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE size_attribute ADD CONSTRAINT FK_75414A90BF396750 FOREIGN KEY (id) REFERENCES attributes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE variants ADD CONSTRAINT FK_B39853E14584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE variant_attributes ADD CONSTRAINT FK_C31A62E53B69A9AF FOREIGN KEY (variant_id) REFERENCES variants (id)');
        $this->addSql('ALTER TABLE variant_attributes ADD CONSTRAINT FK_C31A62E5925DF678 FOREIGN KEY (attributte_id) REFERENCES attributes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668727ACA70');
        $this->addSql('ALTER TABLE color_attribute DROP FOREIGN KEY FK_62744ADCBF396750');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE size_attribute DROP FOREIGN KEY FK_75414A90BF396750');
        $this->addSql('ALTER TABLE variants DROP FOREIGN KEY FK_B39853E14584665A');
        $this->addSql('ALTER TABLE variant_attributes DROP FOREIGN KEY FK_C31A62E53B69A9AF');
        $this->addSql('ALTER TABLE variant_attributes DROP FOREIGN KEY FK_C31A62E5925DF678');
        $this->addSql('DROP TABLE attributes');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE color_attribute');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE size_attribute');
        $this->addSql('DROP TABLE variants');
        $this->addSql('DROP TABLE variant_attributes');
    }
}
