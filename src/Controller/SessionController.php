<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $request): Response
    {
        $session = $request->getSession(); // session_start()
        //$nbreVisite = 0;
        if($session->has('nbreVisite')){
            $nbreVisite = $session->get('nbreVisite') + 1;
        }else{
            $nbreVisite = 1;
        }
        $session->set('nbreVisite', $nbreVisite);

        return $this->render('session/index.html.twig', );
    }
}
