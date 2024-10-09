<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        // Afficher notre tableau de todo selon l'algo suivant:
        
        // Si ma table n'existe pas dans la session, je l'initialise avant de l'afficher.
           if(!$session->has('todos')){
             $todos = [
                'achat' => 'acheter clé usb',
                'courses' => 'finir mes courses', 
                'correction' => 'corriger les copies'
             ];
             $session->set('todos', $todos);
             $this->addFlash('info', "La liste des tâches vient d'être initialisée");
           }
        // Si j'ai ma table todo dans ma session, je l'affiche
        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    #[Route('/todo/add/{name}/{content}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content){
        $session = $request->getSession();
        // Verif si g ma table todo dans la session

        // Si oui
            // Verifier Si on a un todo avec le même name
                 // Si oui: Afficher un mssg d' Erreur
                 // Si non:  Ajouter la tâche suivie d1 mssg de succès
        // Si non
             // Afficher un messg d'erreur et rediriger vers le controleur index

        // ######################################################################"

        if($session->has('todos')){
             // Verifier Si on a un todo avec le même name
             $todos = $session->get('todos');
             if(isset($todo[$name])){
                  // Si oui: Afficher un mssg d'Erreur
                $this->addFlash('error', "Cette tâche d'ID $name existe déjà dans la liste");
             }else{
                 // Si non:  Ajouter la tâche suivie d1 mssg de succès
                $todos[$name] = $content;
                $this->addFlash('success', "Cette tâche d'ID $name est bien ajoutée dans la liste");
                $session->set('todos', $todos);
             }
        }else{
        
            $this->addFlash('error', "La liste des tâches n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');

    }

    
    #[Route('/todo/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content){
        $session = $request->getSession();

        if($session->has('todos')){
             // Verifier Si on a un todo avec le même name
             $todos = $session->get('todos');
             if(!isset($todo[$name])){
                  // Si oui: Afficher un mssg d'Erreur
                $this->addFlash('error', "Cette tâche d'ID $name n'existe pas dans la liste");
             }else{
                 // Si non:  Ajouter la tâche suivie d1 mssg de succès
                $todos[$name] = $content;
                $this->addFlash('success', "Cette tâche d'ID $name est modifié avec succès!");
                $session->set('todos', $todos);
             }
        }else{
        
            $this->addFlash('error', "La liste des tâches n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');

    }

    #[Route('/todo/delete/{name}/{content}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name){
        $session = $request->getSession();

        if($session->has('todos')){
             // Verifier Si on a un todo avec le même name
             $todos = $session->get('todos');
             if(!isset($todo[$name])){
                  // Si oui: Afficher un mssg d'Erreur
                $this->addFlash('error', "Cette tâche d'ID $name n'existe pas dans la liste");
             }else{
                 // Si non:  Ajouter la tâche suivie d1 mssg de succès
                //$todos[$name] = $content;
                unset($todos[$name]);
                $this->addFlash('success', "La tâche d'ID $name est supprimée avec succès!");
                $session->set('todos', $todos);
             }
        }else{
        
            $this->addFlash('error', "La liste des tâches n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');

    }

    #[Route('/todo/reset/{name}/{content}', name: 'todo.reset')]
    public function resetTodo(Request $request){
        $session = $request->getSession();

        $session->remove('todos');

        return $this->redirectToRoute('todo');

    }


    #[Route(
        'multi/{entier1}/{entier2}',
        name:'multiplication',
        requirements:['entier1' => '\d+', 'entier2' => '\d+']
    )]
    public function multiplication($entier1, $entier2){
        $resultat = $entier1 * $entier2;
        return new Response("<h1>$resultat</h1>");
    }
}
