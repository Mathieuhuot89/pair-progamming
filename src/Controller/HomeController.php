<?php

namespace App\Controller;

use App\Repository\VoituresRepository;
use Faker\Provider\Lorem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VoituresRepository $voituresRepository): Response
    {   
        $voitures = $voituresRepository->findALL();
        
        return $this->render('home/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }
}
