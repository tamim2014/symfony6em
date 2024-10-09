<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Personne;
#[Route('/personne')]
class PersonneController extends AbstractController
{
    #[Route('/', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine):response {
       $repository = $doctrine->getRepository(Personne::class); 
       $personnes = $repository->findAll();

       return $this->render('personne/index.html.twig', [
        'personnes' => $personnes
       ]);
    }

    #[Route('/alls/{page?1}/{nbre?12}', name: 'personne.list.alls')]
    public function indexAlls(ManagerRegistry $doctrine, $page, $nbre):response {
       $repository = $doctrine->getRepository(Personne::class); 
       $personnes = $repository->findBy([],[], $nbre, offset:($page -1)*$nbre);

       return $this->render('personne/index.html.twig', [
        'personnes' => $personnes
       ]);
    }

    #[Route('/{id}', name: 'personne.detail')]
    public function detail(ManagerRegistry $doctrine, $id):response {
       $repository = $doctrine->getRepository(Personne::class); 
       $personne = $repository->find($id);
       if(!$personne){
          $this->addFlash('error', "La personne d'id $id n'existe pas");
          return $this->redirectToRoute('personne.list');
       }
       return $this->render('personne/detail.html.twig', [
        'personne' => $personne
       ]);
    }

    #[Route('/add', name: 'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
       // $this->getDoctrine() : sf <= 5
       $entityManager = $doctrine->getManager();
       $personne = new Personne();
      // $personne2 = new Personne();

       $personne->setNom('Ali');
       $personne->setPrenom('Baba');
       $personne->setAge('91');

       
      
       //$personne2->setNom('Toto');
       //$personne2->setPrenom('Tata');
       //$personne2->setAge('21');

  
       // INSERTION objet
       $entityManager->persist($personne);
      // $entityManager->persist($personne2);
       // INSERTION sql(migration objet vers sql)
       $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
            //'personne2' => $personne2
           
        ]);
    }
}
