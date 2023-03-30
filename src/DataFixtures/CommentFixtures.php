<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Voiture;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private VoitureRepository $voitureRepository,
    )
    {
        
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // On récupère toutes les voitures pour les associer aux commentaires
        $voitures = $this->voitureRepository->findAll();

        // On crée de 0 à 15 commentaires fictifs pour chaque voiture
        foreach ($voitures as $voiture) {
            for ($i = 0; $i < mt_rand(0, 15); $i++) {
                $comment = new Comment();
                $comment->setContent($faker->realText());
                $comment->setIsApproved(mt_rand(0, 3) === 0? false : true);
                $comment->setAuthor($this->userRepository->findOneBy([]));
                $comment->setVoiture($voiture);

                $manager->persist($comment);
                $voiture->addComment($comment);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            VoitureFixtures::class,
        ];
    }
}
