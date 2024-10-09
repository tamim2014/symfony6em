<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TableController extends AbstractController
{
    #[Route('/table/{nb<\d+>?5}', name: 'table')]
    public function index($nb): Response
    {
        $notes = [];
        for($i=0; $i<$nb; $i++){
            $notes = rand(0, 20);
        }
        return $this->render('table/index.html.twig', [
            'notes' => $notes
        ]);
    }
}
