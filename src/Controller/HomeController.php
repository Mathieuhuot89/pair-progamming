<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(VoitureRepository $voitureRepository): Response
    {   

        $voitures = $voitureRepository->findAll();
        
        return $this->render('home/index.html.twig', [
        'voitures' => $voitures,
        ]);
    }
}
