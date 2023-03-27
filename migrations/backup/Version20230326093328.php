<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326093328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__commande AS SELECT id, user_id, montant, nb_jour_loc, jour_depart, jour_arrive, created_at, status FROM commande');
        $this->addSql('CREATE TABLE commande (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, montant DOUBLE PRECISION NOT NULL, nb_jour_loc INTEGER NOT NULL, jour_depart DATETIME NOT NULL, jour_arrive DATETIME NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , status BOOLEAN NOT NULL, CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commande (id, user_id, montant, nb_jour_loc, jour_depart, jour_arrive, created_at, status) SELECT id, user_id, montant, nb_jour_loc, jour_depart, jour_arrive, created_at, status FROM __temp__commande');
        $this->addSql('DROP TABLE __temp__commande');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__voiture AS SELECT id, marque_id, nom, description, image_url, couleur, prix_journalier, slug, stock, created_at, updated_at FROM voiture');
        $this->addSql('CREATE TABLE voiture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, marque_id INTEGER NOT NULL, commande_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, prix_journalier INTEGER NOT NULL, slug VARCHAR(255) NOT NULL, stock INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_E9E2810F4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E9E2810F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO voiture (id, marque_id, nom, description, image_url, couleur, prix_journalier, slug, stock, created_at, updated_at) SELECT id, marque_id, nom, description, image_url, couleur, prix_journalier, slug, stock, created_at, updated_at FROM __temp__voiture');
        $this->addSql('DROP TABLE __temp__voiture');
        $this->addSql('CREATE INDEX IDX_E9E2810F4827B9B2 ON voiture (marque_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F82EA2E54 ON voiture (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__commande AS SELECT id, user_id, montant, nb_jour_loc, jour_depart, jour_arrive, created_at, status FROM commande');
        $this->addSql('DROP TABLE commande');
        $this->addSql('CREATE TABLE commande (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, voiture_id INTEGER DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, nb_jour_loc INTEGER NOT NULL, jour_depart DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , jour_arrive DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , status BOOLEAN NOT NULL, CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6EEAA67D181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commande (id, user_id, montant, nb_jour_loc, jour_depart, jour_arrive, created_at, status) SELECT id, user_id, montant, nb_jour_loc, jour_depart, jour_arrive, created_at, status FROM __temp__commande');
        $this->addSql('DROP TABLE __temp__commande');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D181A8BA ON commande (voiture_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__voiture AS SELECT id, marque_id, nom, description, image_url, couleur, prix_journalier, slug, stock, created_at, updated_at FROM voiture');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('CREATE TABLE voiture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, marque_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, prix_journalier INTEGER NOT NULL, slug VARCHAR(255) NOT NULL, stock INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_E9E2810F4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO voiture (id, marque_id, nom, description, image_url, couleur, prix_journalier, slug, stock, created_at, updated_at) SELECT id, marque_id, nom, description, image_url, couleur, prix_journalier, slug, stock, created_at, updated_at FROM __temp__voiture');
        $this->addSql('DROP TABLE __temp__voiture');
        $this->addSql('CREATE INDEX IDX_E9E2810F4827B9B2 ON voiture (marque_id)');
    }
}
