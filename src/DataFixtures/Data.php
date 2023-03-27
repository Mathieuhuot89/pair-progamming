<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Marque;
use App\Entity\Voiture;
use App\Entity\Commande;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use SebastianBergmann\CodeCoverage\Report\Xml\Facade;

class Data extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = [];

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setPrenom($faker->firstName);
            $user->setNom($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword(password_hash('user', PASSWORD_DEFAULT));
            $user->setRoles([]);
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setAdresse($faker->address);
            $user->setVille($faker->city);
            $user->setCodePostal($faker->randomNumber(5, true));
            $user->setPays($faker->country);

            $manager->persist($user);
            $users[] = $user;
        }

        // $catNames = [
        //     'Mercedes',
        //     'BMW',
        //     'Audi',
        //     'Wolfwagen',
        //     'Ford',
        // ];
        $marques = [];
        $voitures = [];

        $slugify = new Slugify();

        ##MARQUE -------------------

        $marque = new Marque();
        $marque->setNom('Mercedes');
        $marque->setDescription('Nos catégories de Mercedes');
        $marque->setLogo('https://www.icon-icon.com/wp-content/uploads/2021/05/30356-Mercedes-Benz.png');
        $marque->setSlug($slugify->slugify($marque->getNom()));
        $marque->setCreatedAt(new \DateTimeImmutable());
        // $marque->addVoiture($voitures['Class A']);
        $marques['Mercedes'] = $marque;
        $manager->persist($marque);

        $marque1 = new Marque();
        $marque1->setNom('Audi');
        $marque1->setDescription('Nos catégories de Audi');
        $marque1->setLogo('https://upload.wikimedia.org/wikipedia/fr/1/15/Audi_logo.svg');
        $marque1->setSlug($slugify->slugify($marque1->getNom()));
        $marque1->setCreatedAt(new \DateTimeImmutable());
        $marques['Audi'] = $marque1;
        $manager->persist($marque1);

        $marque2 = new Marque();
        $marque2->setNom('BMW');
        $marque2->setDescription('Nos catégories de BMW');
        $marque2->setLogo('https://images.pexels.com/photos/3689532/pexels-photo-3689532.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
        $marque2->setSlug($slugify->slugify($marque2->getNom()));
        $marque2->setCreatedAt(new \DateTimeImmutable());
        // $marque1->addVoiture($voitures['Class A']);
        $marques['BMW'] = $marque2;
        $manager->persist($marque2);

        ##VOITURE -------------------

        $voiture = new Voiture();
        $voiture->setNom('Class A');
        $voiture->setSlug($slugify->slugify($voiture->getNom()));
        $voiture->setDescription("La Mercedes-Benz Classe A est une gamme d'automobiles du constructeur allemand Mercedes-Benz. La première génération est lancée en 1997 (Type 168) puis une seconde en 2004 (Type 169), renouvelée en 2012 (Type 176) et enfin une quatrième en 2018 (Type 177).

        Les deux premières générations correspondaient à une citadine dont le plancher double lui donnait un aspect rehaussé. Elle pouvait, de ce fait, appartenir à la catégorie des mini monospaces, malgré son aménagement intérieur classique. Les troisième et quatrième générations de Classe A abandonne la formule du mini monospace pour devenir une berline compacte premium.
        
        La Mercedes-Benz Classe A Type 176 a été élue plus belle voiture de l'année 20121 à l'occasion de l’inauguration du Festival international automobile.");
        $voiture->setPrixJournalier('120');
        $voiture->setImageUrl('https://www.jns-motors.fr/wp-content/uploads/2021/03/image1-2021-03-22T113507.986-4031x3023.jpeg');
        $voiture->setCouleur('Blanche');
        $voiture->setStock(7);
        $voiture->setMarque($marque);
        $voiture->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture;
        $manager->persist($voiture);

        $voiture5 = new Voiture();
        $voiture5->setNom('Q7');
        $voiture5->setSlug($slugify->slugify($voiture5->getNom()));
        $voiture5->setDescription("L'Audi Q7 est un SUV haut de gamme de la firme allemande Audi présenté en 2005, et sortie en concession à la fin de l'année 2005. La seconde génération a été présentée en 2015.
        Début 2005, le Japonais Nissan dépose une plainte contre Audi pour l'utilisation de la lettre « Q » pour un modèle de voiture1. Audi utilisait cette lettre pour désigner le système quatre roues motrices des Quattro depuis plus de 25 ans (la marque déposée « Quattro » d'Audi est utilisée pour plusieurs types de systèmes 4x4 développés par Torsen, Haldex Traction AB, et BorgWarner, ce dernier étant utilisé dans la Q7). Nissan utilisait la lettre « Q » pour la dénomination des berlines haut de gamme de sa marque Infiniti (la Q45) et les SUVs (la QX4 et la QX56) depuis 1989. Fin 2006, un arrangement est trouvé entre les deux marques, lequel spécifie qu'Audi n'utilisera ce préfixe que pour trois modèles, les Audi Q3, Q5 et Q7");
        $voiture5->setPrixJournalier('400');
        $voiture5->setImageUrl('https://img.paruvendu.fr/media_ext/_https_/photos.publicationvo.com/4c/08/L2NhcmRpZmYvVk8vWERJVC9YRElULTEzMTgwLTE4ODc5Mi5qcGc_bWQ1PTIwNDBmYzIyOTZmMGI1Yjk5NGMwMDRkYWFhOWFiZjU0_rct?func=crop&w=480&gravity=auto');
        $voiture5->setCouleur('Noir');
        $voiture5->setStock(4);
        $voiture5->setMarque($marques['Audi']);
        $voiture5->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture5;
        $manager->persist($voiture5);

        $voiture1 = new Voiture();
        $voiture1->setNom('Class E');
        $voiture1->setSlug($slugify->slugify($voiture1->getNom()));
        $voiture1->setDescription("La Mercedes-Benz Classe E est une gamme d'automobiles du constructeur allemand Mercedes-Benz. La première génération est lancée en 1997 (Type 168) puis une seconde en 2004 (Type 169), renouvelée en 2012 (Type 176) et enfin une quatrième en 2018 (Type 177).

        Les deux premières générations correspondaient à une citadine dont le plancher double lui donnait un aspect rehaussé. Elle pouvait, de ce fait, appartenir à la catégorie des mini monospaces, malgré son aménagement intérieur classique. Les troisième et quatrième générations de Classe A abandonne la formule du mini monospace pour devenir une berline compacte premium.
        
        La Mercedes-Benz Classe A Type 176 a été élue plus belle voiture1 de l'année 20121 à l'occasion de l’inauguration du Festival international automobile.");
        $voiture1->setPrixJournalier('150');
        $voiture1->setImageUrl('https://images.caradisiac.com/logos/9/2/3/4/189234/S8-Mercedes-Classe-E-Classe-C-et-Classe-S-la-panne-de-style-106207.jpg');
        $voiture1->setCouleur('grise');
        $voiture1->setStock(2);
        $voiture1->setMarque($marque);
        $voiture1->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture1;
        $manager->persist($voiture1);

        $voiture6 = new Voiture();
        $voiture6->setNom('X6');
        $voiture6->setSlug($slugify->slugify($voiture6->getNom()));
        $voiture6->setDescription("La BMW X6 est la première automobile de type Sports Activity Coupé (ou SUV coupé) du constructeur automobile allemand BMW. La première génération est présentée au salon de Détroit 2008 et commercialisée la même année, la seconde en 2014 et la troisième en 2019.
        La conception allie l'agilité d'un tout-terrain et la sportivité d'un coupé. Il est construit sur la base d'une X5 mais est plus long de 3 cm. Intérieurement, il utilise largement les instruments et pièces de la X5. Quelques ajouts l'en distinguent comme les appuis genoux et les palettes au volant. Seul vrai changement majeur, le passage de trois sièges arrière à deux sièges sport individuels (bien qu'une option pour obtenir une troisième place soit créée en 2011).");
        $voiture6->setPrixJournalier('450');
        $voiture6->setImageUrl('https://www.excelcar66.com/photos/X6-001.jpg');
        $voiture6->setCouleur('Blanc');
        $voiture6->setStock(2);
        $voiture6->setMarque($marques['BMW']);
        $voiture6->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture6;
        $manager->persist($voiture6);


        $voiture2 = new Voiture();
        $voiture2->setNom('Class G');
        $voiture2->setSlug($slugify->slugify($voiture2->getNom()));
        $voiture2->setDescription("La Mercedes-Benz Classe G est une gamme d'automobiles du constructeur allemand Mercedes-Benz. La première génération est lancée en 1997 (Type 168) puis une seconde en 2004 (Type 169), renouvelée en 2012 (Type 176) et enfin une quatrième en 2018 (Type 177).

        Les deux premières générations correspondaient à une citadine dont le plancher double lui donnait un aspect rehaussé. Elle pouvait, de ce fait, appartenir à la catégorie des mini monospaces, malgré son aménagement intérieur classique. Les troisième et quatrième générations de Classe A abandonne la formule du mini monospace pour devenir une berline compacte premium.
        
        La Mercedes-Benz Classe A Type 176 a été élue plus belle voiture de l'année 20121 à l'occasion de l’inauguration du Festival international automobile.");
        $voiture2->setPrixJournalier('150');
        $voiture2->setImageUrl('https://images.pexels.com/photos/8622819/pexels-photo-8622819.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
        $voiture2->setCouleur('Rouge');
        $voiture2->setStock(6);
        $voiture2->setMarque($marque);
        $voiture2->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture2;
        $manager->persist($voiture2);


        $voiture3 = new Voiture();
        $voiture3->setNom('A3');
        $voiture3->setSlug($slugify->slugify($voiture3->getNom()));
        $voiture3->setDescription("L'Audi A3 est une berline bicorps compacte du constructeur automobile allemand Audi produite depuis 1996.");
        $voiture3->setPrixJournalier('210');
        $voiture3->setImageUrl('https://photoref.carboatservices.fr/QVVESQ==/QTM=/87990757493a47aadd302a8b141ea57b/MQ==/6c113ac5125dc3a7cd524fc6fa88425d.png');
        $voiture3->setCouleur('Bleu');
        $voiture3->setStock(3);
        $voiture3->setMarque($marque1);
        $voiture3->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture3;
        $manager->persist($voiture3);


        $voiture7 = new Voiture();
        $voiture7->setNom('M4');
        $voiture7->setSlug($slugify->slugify($voiture7->getNom()));
        $voiture7->setDescription("La BMW M4 est un coupé du constructeur automobile allemand BMW M du groupe BMW, commercialisée de 2014 à 2021. Basée sur la BMW Série 4, elle s'inscrit dans la lignée et dans la philosophie des BMW M3, avec pour vocation de remplacer la BMW série 3 coupé.");
        $voiture7->setPrixJournalier('550');
        $voiture7->setImageUrl('https://upload.wikimedia.org/wikipedia/commons/6/68/2014_Canadian_International_AutoShow_0148_%2812646102484%29.jpg');
        $voiture7->setCouleur('Jaune');
        $voiture7->setStock(3);
        $voiture7->setMarque($marques['BMW']);
        $voiture7->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture7;
        $manager->persist($voiture7);

        

        $voiture4 = new Voiture();
        $voiture4->setNom('R8');
        $voiture4->setSlug($slugify->slugify($voiture4->getNom()));
        $voiture4->setDescription("L'Audi R8 est une voiture de sport du constructeur allemand Audi. C'est le premier coupé GT deux-places de la marque qui rivalise ainsi avec les marques historiques de ce segment : Porsche, Ferrari, Chevrolet ou Aston Martin.

        L'Audi R8 tire son nom de la voiture de course homonyme, victorieuse aux 24 Heures du Mans. Le show-car Avus du salon automobile de Francfort de 1991, le prototype Audi quattro Spyder1 ou encore le concept-car Audi Le Mans quattro qui inaugura les LED, furent les inspirateurs2 de la R8 de série. La R8 fut officiellement présentée au mondial de l'automobile de Paris de 2006 et est présente dans les concessions Audi depuis avril 2007. Elle est produite à Neckarsulm (Bade-Wurtemberg) en Allemagne ; sa construction est organisée comme dans une manufacture3 où des spécialistes vérifient la qualité de chaque pièceNote 1. Le prix de l'Audi, tout comme celui de ses concurrentes, dépasse la barre des 100 000 €, sans les options");
        $voiture4->setPrixJournalier('800');
        $voiture4->setImageUrl('https://images.caradisiac.com/logos-ref/gamme/gamme--audi-r8/S7-gamme--audi-r8.jpg');
        $voiture4->setCouleur('Blanc');
        $voiture4->setStock(1);
        $voiture4->setMarque($marque1);
        $voiture4->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture4;
        $manager->persist($voiture4);


        $voiture8 = new Voiture();
        $voiture8->setNom('M2');
        $voiture8->setSlug($slugify->slugify($voiture8->getNom()));
        $voiture8->setDescription("La M2 est propulsée par le moteur six cylindres en ligne turbocompressé de 3,0 litres. Il développe 272 kW (365 ch) à 6 500 tr/min et 465 Nm, entre 1 450 et 4 750 tr/min, tandis qu'une fonction de suralimentation augmente temporairement le couple à 500 Nm");
        $voiture8->setPrixJournalier('380');
        $voiture8->setImageUrl('https://www.largus.fr/images/2022-10/bmw-m2-2022-rouge-avd.jpg');
        $voiture8->setCouleur('Rouge');
        $voiture8->setStock(4);
        $voiture8->setMarque($marques['BMW']);
        $voiture8->setCreatedAt(new \DateTimeImmutable());
        $voitures[] = $voiture8;
        $manager->persist($voiture8);

        ## COMMANDES --------------------

        // $commandes = [];

        // $commande = new Commande();
        // $commande->setMontant('550');
        // $commande->setNbJourLoc('2');
        // $commande->setJourDepart(new \DateTimeImmutable());
        // $commande->setJourArrive(new \DateTimeImmutable());
        // $commande->setCreatedAt(new \DateTimeImmutable());
        // $commande->setStatus(true);
        // $commande->setUser($faker->randomElement($users));
        // $commande->setVoiture($faker->randomElement($voitures));
        // $commandes[] = $commande;
        // $manager->persist($commande);

        // $commande1 = new Commande();
        // $commande1->setMontant('1050');
        // $commande1->setNbJourLoc('4');
        // $commande1->setJourDepart(new \DateTimeImmutable());
        // $commande1->setJourArrive(new \DateTimeImmutable());
        // $commande1->setCreatedAt(new \DateTimeImmutable());
        // $commande1->setStatus(true);
        // $commande1->setUser($faker->randomElement($users));
        // $commande1->setVoiture($faker->randomElement($voitures));
        // $commandes[] = $commande1;
        // $manager->persist($commande1);

        // $commande2 = new Commande();
        // $commande2->setMontant('1250');
        // $commande2->setNbJourLoc('3');
        // $commande2->setJourDepart(new \DateTimeImmutable());
        // $commande2->setJourArrive(new \DateTimeImmutable());
        // $commande2->setCreatedAt(new \DateTimeImmutable());
        // $commande2->setStatus(true);
        // $commande2->setUser($faker->randomElement($users));
        // $commande2->setVoiture($faker->randomElement($voitures));
        // $commandes[] = $commande2;
        // $manager->persist($commande2);


        // $commande3 = new Commande();
        // $commande3->setMontant('950');
        // $commande3->setNbJourLoc('5');
        // $commande3->setJourDepart(new \DateTimeImmutable());
        // $commande3->setJourArrive(new \DateTimeImmutable());
        // $commande3->setCreatedAt(new \DateTimeImmutable());
        // $commande3->setStatus(true);
        // $commande3->setUser($faker->randomElement($users));
        // $commande3->setVoiture($faker->randomElement($voitures));
        // $commandes[] = $commande3;
        // $manager->persist($commande3);


        // $voiture1 = new Voiture();
        // $voiture1->setNom('Class E');
        // $voiture1->setSlug($slugify->slugify($voiture1->getNom()));
        // // $voiture1->setCategorie('Mercedes');
        // $voiture1->setDescription("La Mercedes-Benz Classe E est une gamme d'automobile routière du constructeur allemand Mercedes-Benz existant en berline, break, limousine, coupé et cabriolet. Cinq générations se succèdent, lancées en 1993 (Type 124) puis en 1995 (Type 210), en 2002 (Type 211), en 2009 (Type 212) et enfin en 2016 (Type 213). La première Classe E, datant de 1993 (Type 124 phase 3), remplace la Type 124 phase 2 des séries 200, 300, 400 et 500.");
        // $voiture1->setPrixJournalier('150');
        // $voiture1->setImageUrl('https://i.gaw.to/vehicles/photos/40/31/403116-2023-mercedes-benz-e-class.jpg');
        // $voiture1->setCouleur('Grise');
        // $voiture1->setMarque($marques['Mercedes']);
        // // $voiture1->setCommande($commandes[]);
        // $voitures[] = $voiture1;
        // $manager->persist($voiture1);




        // foreach ($catNames as $name) {
        //     $category = new Marque();
        //     $category->setNom($name);
        //     $category->setSlug($slugify->slugify($name));
        //     $category->setDescription($faker->paragraph(3));
        //     $category->setLogo($faker->imageUrl(640, 480, 'cars', true));
        //     $category->setCreateAt(new \DateTimeImmutable());
        //     // $category->addVoiture($voitures);

        //     $manager->persist($category);
        //     $categories[] = $category;
        // }

        


        $manager->flush();
    }
}
