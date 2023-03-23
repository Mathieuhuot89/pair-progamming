<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Voitures;
use App\Entity\Categorie;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use SebastianBergmann\CodeCoverage\Report\Xml\Facade;

class Data extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

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

        $categories =[];
        $catNames = [
            'Mercedes',
            'BMW',
            'Audi',
            'Wolfwagen',
            'Ford',
        ];
        $slugify = new Slugify();

        foreach ($catNames as $name) {
            $category = new Categorie();
            $category->setNom($name);
            // $category->setSlug($slugify->slugify($name));
            $category->setDescription($faker->paragraph(3));
            $category->setImageUrl($faker->imageUrl(640, 480, 'cars', true));
            $category->setCreateAt(new \DateTimeImmutable());

            $manager->persist($category);
            $categories[] = $category;
        }

        for($i=0;$i<50;$i++){
            $voiture = new Voitures();
            $voiture->setMarque($faker->randomElement($catNames));
            $voiture->setDescription($faker->paragraph(6));
            $voiture->setCreatedAt(new \DateTimeImmutable());
            $voiture->setSlug($slugify->slugify($voiture->getMarque()));
            $voiture->setCouleur($faker->hexColor());
            $voiture->setImageUrl($faker->imageUrl(640, 480, 'cats', true));
            $voiture->setPrix(mt_rand(100, 1000));
            $voiture->addCategory($faker->randomElement($categories));
            $manager->persist($voiture);
        }

        $manager->flush();
    }
}
