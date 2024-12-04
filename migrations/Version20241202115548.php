<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202115548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_material (produit_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_55A14786F347EFB (produit_id), INDEX IDX_55A14786E308AC6F (material_id), PRIMARY KEY(produit_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_material ADD CONSTRAINT FK_55A14786F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_material ADD CONSTRAINT FK_55A14786E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2744F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2744F5D008 ON produit (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_material DROP FOREIGN KEY FK_55A14786F347EFB');
        $this->addSql('ALTER TABLE produit_material DROP FOREIGN KEY FK_55A14786E308AC6F');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE produit_material');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2744F5D008');
        $this->addSql('DROP INDEX IDX_29A5EC2744F5D008 ON produit');
        $this->addSql('ALTER TABLE produit DROP brand_id');
    }
}
