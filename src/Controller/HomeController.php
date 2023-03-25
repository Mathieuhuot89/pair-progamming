<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\MarqueRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();
        return $this->render('home/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    #[Route('/voiture/{id}', name: 'app_voiture')]
    public function voiture(VoitureRepository $voitureRepository, $id): Response
    {
        $voiture = $voitureRepository->find($id);

        return $this->render('home/voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    #[Route('/marque/{id}', name: 'app_marque')]
    public function marque(EntityManagerInterface $entityManager, MarqueRepository $marqueRepository, VoitureRepository $voitureRepository, $id): Response
    {
        $voitures = $entityManager->getRepository(Voiture::class)->findBy(['marque' => $id]);
        $marque = $marqueRepository->find($id);
        // $voitures  = $voitureRepository->findBy(['marque' => $id]);

        return $this->render('home/categorie.html.twig', [
            'voitures' => $voitures,
            'marque' => $marque,
        ]);
    }
}
