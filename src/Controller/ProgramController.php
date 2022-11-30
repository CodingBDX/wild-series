<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

           #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'id')]
     public function show(int $id = 1): Response
     {
         if (true === !is_int($id)) {
             return $this->redirectToRoute('404', 'error 404');
         }

         return $this->render('program/show.html.twig', ['id' => $id]);
     }

       #[Route('/list/{page}', requirements: ['page' => '\d+'], name: 'list')]
     public function list(int $page = 1): Response
     {
         return $this->render('program/list.html.twig', ['page' => $page]);
     }

    #[Route('/new', name: 'new')]
     public function new(): Response
     {
         // traitement d'un formulaire par exemple

         // redirection vers la page 'program_show',

         // correspondant à l'url /program/4

         return $this->redirectToRoute('program_show', ['id' => 4]);
     }
}
