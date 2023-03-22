<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322101313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_voitures (categorie_id INT NOT NULL, voitures_id INT NOT NULL, INDEX IDX_B3DF7171BCF5E72D (categorie_id), INDEX IDX_B3DF7171CCC4661F (voitures_id), PRIMARY KEY(categorie_id, voitures_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voitures (id INT AUTO_INCREMENT NOT NULL, marque VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_voitures ADD CONSTRAINT FK_B3DF7171BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_voitures ADD CONSTRAINT FK_B3DF7171CCC4661F FOREIGN KEY (voitures_id) REFERENCES voitures (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_voitures DROP FOREIGN KEY FK_B3DF7171BCF5E72D');
        $this->addSql('ALTER TABLE categorie_voitures DROP FOREIGN KEY FK_B3DF7171CCC4661F');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_voitures');
        $this->addSql('DROP TABLE voitures');
    }
}
