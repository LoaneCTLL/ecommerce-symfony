<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class KiwiController extends AbstractController
{
    #[Route('/kiwi', name: 'app_kiwi')]
    public function index(): Response
    {

        $fruits =['fraise', 'banane', 'kiwi', 'pomme', 'poire'];

        


        return $this->render('kiwi/index.html.twig', [
            'controller_name' => 'KiwiController',
            'isConnected' => true,
            'prenomTwig' =>'Loane',
            'fruits' => $fruits
    
        ]);
    }

    // Nouvelle méthode avec une nouvelle route
    #[Route('/catalogue', name: 'app_catalogue')]
    public function catalogue():Response
    {
        $message = "Bienvenue sur la page catalogue";
        $prenom = "Loane";
        return $this->render('kiwi/catalogue.html.twig',[
            'message' => $message,
            'prenom' => $prenom
        ]);

    }
}