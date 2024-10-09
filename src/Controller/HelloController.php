<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{prenom}/{nom}', name: 'app_hello')]
    public function index($prenom, $nom): Response
    {
        return $this->render('hello/index.html.twig', [
           
            'leprenom' =>  $prenom,
            "lenom"  =>  $nom
         
        ]);
    }
}
