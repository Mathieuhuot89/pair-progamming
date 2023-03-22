<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322103418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_voitures (user_id INT NOT NULL, voitures_id INT NOT NULL, INDEX IDX_6BD5D41BA76ED395 (user_id), INDEX IDX_6BD5D41BCCC4661F (voitures_id), PRIMARY KEY(user_id, voitures_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_voitures ADD CONSTRAINT FK_6BD5D41BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_voitures ADD CONSTRAINT FK_6BD5D41BCCC4661F FOREIGN KEY (voitures_id) REFERENCES voitures (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_voitures DROP FOREIGN KEY FK_6BD5D41BA76ED395');
        $this->addSql('ALTER TABLE user_voitures DROP FOREIGN KEY FK_6BD5D41BCCC4661F');
        $this->addSql('DROP TABLE user_voitures');
    }
}
