<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/voiture/{id}', name: 'app_article')]
    public function article(VoitureRepository $voitureRepository, $id): Response
    {
        $voiture = $voitureRepository->find($id);

        return $this->render('home/voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }
}
