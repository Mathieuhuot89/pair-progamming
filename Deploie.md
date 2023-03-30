# Les étapes pour le déploiement de l'application sur un serveur distant sont les suivantes :

# 1. Créer un utilisateur sur le serveur distant et lui donner les droits sudo

***Cas de ionos***

- Se connecter à son compte ionos et allez dans hébergement SFTP & SSH
- Cliquer sur "Ajouter un utilisateur" ou "Ajouter un utilisateur SSH" si vous voulez déploier via SSH l'utilisateur doit avoir les droits acces au protocole SSH
- Une fois l'utilisateur créé, cliquer sur "Gérer les droits" et cocher "Accès SSH" et "Accès SFTP"

- Se connecter en SSH sur le serveur distant et créer un utilisateur avec les droits sudo

Aller dans votre terminal et taper la commande suivante :

`ssh NomUtilisateur@NomServeur` puis valider avec la touche entrée et taper le mot de passe de l'utilisateur

# 2. Installer les dépendances de l'application

- Installer composer sur le serveur distant
`curl -sS https://getcomposer.org/installer | php` ou `sudo apt-get install composer` ou aller sur le site officiel de composer et suivre les instructions d'installation et prendre les ligne de commande qui se trouve dans la partie "Command-line installation" du site officiel de composer

pour vérifier taper `php composer.phar`

- importer le projet sur le serveur distant

`git clone votreUrlDeProjet`

- aller dans le dossier du projet et taper la commande suivante pour installer les dépendances

`cd NomDuProjet` pour aller dans le dossier du projet

`composer install` pour installer les dépendances

# 3. Configurer l'application

- Allez sur votre FTP et ouvrez le fichier `.env` et modifier les informations de connexion à la base de données 

- Créer une base de données sur le serveur distant et importer le fichier `NomDuProjet.sql` qui se trouve dans le dossier `database` du projet

- Dans le fichier `.env` modifier la ligne de connexion à la base de données

`DATABASE_URL=mysql://NomUtilisateur:MotDePasse@NomServeur/NomBaseDeDonnées`

- Changer aussi l'environnement de l'application

`APP_ENV=prod`

- faire les migrations de la base de données

`php bin/console doctrine:migrations:migrate`

- charger les fixtures

`php bin/console doctrine:fixtures:load`

# 4. Configurer le serveur web

- Supprimer le dossier www du projet sur le serveur distant

`rm -rf www`

- Créer un lien symbolique vers le dossier public du projet

`ln -s NomDuProjet/public www`

# Deploier l'application sur heroku

- Créer un compte sur heroku

- Installer heroku sur votre machine

`sudo snap install --classic heroku`

- Se connecter à heroku

`heroku login`

- Créer une application sur heroku

`heroku create`

- Cliquer sur `new ` puis `create new app`

- Choisir un nom pour l'application

- Aller dans settings de l'application et cliquer sur `Reveal Config Vars`

- Ajouter les variables d'environnement suivantes

`APP_ENV=prod`

- Aller dans ressources de l'application et rechercher `JawsDB MySQL` ou `ClearDB MySQL` et ajouter puis cliquer sur `Provision`

- Aller dans `settings` de l'application et cliquer sur `Reveal Config Vars`

`DATABASE_URL=mysql://NomUtilisateur:MotDePasse@NomServeur/NomBaseDeDonnées`

- Aller dans `deploy` de l'application et cliquer sur `Connect to GitHub`

- Choisir le dépôt du projet

- Cliquer sur `Enable Automatic Deploys`

- Cliquer sur `Deploy Branch`

- Cliquer sur `Open App` pour voir l'application en ligne

- Ajouter le fichier `Procfile` à la racine du projet avec le contenu suivant

`web: vendor/bin/heroku-php-apache2 public/`

- Aller sur packagist et rechercher `apache-pack` et cliquer sur `install`

- Refaire un déploiement sur heroku

### Bonne chance pour le déploiement de votre application

