<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

           #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'show')]
     public function show(int $id, ProgramRepository $programRepository): Response
     {
         $program = $programRepository->findOneBy(['id' => $id]);

         if (true === !is_int($id)) {
             return $this->redirectToRoute('404', 'error 404');
         }

         return $this->render('program/show.html.twig', ['program' => $program]);
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
