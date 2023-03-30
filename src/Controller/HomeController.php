<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Voiture;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\MarqueRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VoitureRepository $voitureRepository, PaginatorInterface $paginator, Request $request): Response
    {
            $pagination = $paginator->paginate(
            $voitureRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            8 /*limit per page*/
        );

        $voitures = $voitureRepository->findAll();
        return $this->render('home/index.html.twig', [
            'voitures' => $pagination,
        ]);
    }

    #[Route('/voiture/{id}', name: 'app_voiture')]
    public function voiture(VoitureRepository $voitureRepository, $id): Response
    {
        $voiture = $voitureRepository->find($id);

        return $this->render('home/voiture.html.twig', [
            'voiture' => $voiture,
            ''
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


    #[Route('/reservation/{id}', name: 'app_reservation')]
    public function reservation(Request $request, EntityManagerInterface $entityManager, $id): Response
    {   
        dump($id);
        $voiture = $entityManager->getRepository(Voiture::class)->findOneBy(['id' => $id]);
        $customer = $this->getUser();
        
        // dump($request);die();
        // $marque = $marqueRepository->find($id);
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        $commande->setCreatedAt(new \DateTimeImmutable());
        

        if ($form->isSubmitted() && $form->isValid()) {
            $diff = date_diff($commande->getJourDepart(), $commande->getJourArrive());
            $nbJourLoc = $diff->days+1;
            $commande->setMontant($voiture->getPrixJournalier() * $nbJourLoc);
            $commande->setNbJourLoc($nbJourLoc);
            $commande->setUser($customer);
            $commande->setVoiture($voiture);
            $commande->setStatus(true);

            $voiture->setStock($voiture->getStock()-1);
            // dump($voiture);
            // dump($commande);die();
            $entityManager->persist($commande);
            $entityManager->persist($voiture);
            $entityManager->flush();

            // add flashes - app.flashes

            return $this->render('home/reservation.html.twig', [
                'reservationForm' => $form->createView(),
                'stock' => $voiture->getStock(),
                'voiture' => $voiture,
                'total' => $voiture->getPrixJournalier() * $nbJourLoc,
            ]);
        }

        return $this->render('home/reservation.html.twig', [
            'reservationForm' => $form->createView(),
            'stock' => $voiture->getStock(),
            'voiture' => $voiture,
        ]);
    }

}
