<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
// Don't forget the Request use !!
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
public function new(Request $request, ProgramRepository $programRepository): Response
{
    // Create a new Category Object

    $program = new Program();

    // Create the associated Form

    $form = $this->createForm(ProgramType::class, $program);

    // Get data from HTTP request

    $form->handleRequest($request);

    // Was the form submitted ?

    if ($form->isSubmitted()) {
        // Deal with the submitted data

        $programRepository->save($program, true);
        $this->addFlash('success', 'Form submit success!');

        // Redirect to categories list

        return $this->redirectToRoute('program_new');
        // For example : persiste & flush the entity

        // And redirect to a route that display the result
    }

    // Render the form

    return $this->renderForm('program/new.html.twig', [
        'form' => $form,
    ]);
}
}
