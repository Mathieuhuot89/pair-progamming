<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(MarqueRepository $marquerepository): Response
    {
        
        $marques=$marquerepository->findAll();
        // dd($marque);

        return $this->render('categorie/index.html.twig', [
          'marques' => $marques 
        
        ]);
    }
}
