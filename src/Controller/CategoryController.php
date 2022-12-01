<?php

namespace App\Controller;

// Don't forget the Request use !!
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }

     #[Route('/test/{categoryName}', methods: ['GET'], name: 'show')]
     public function show(string $categoryName, CategoryRepository $categoryRepository): Response
     {
         $category = $categoryRepository->findOneBy(['name' => $categoryName]);

         if (!$category) {
             throw $this->createNotFoundException(
                 'No category with name : '.$categoryName.' found in categorie\'s table.'
             );
         }

         return $this->render('category/show.html.twig', ['category' => $category]);
     }

     #[Route('/new', name: 'new')]
public function new(Request $request, CategoryRepository $categoryRepository): Response
{
    // Create a new Category Object

    $category = new Category();

    // Create the associated Form

    $form = $this->createForm(CategoryType::class, $category);

    // Get data from HTTP request

    $form->handleRequest($request);

    // Was the form submitted ?

    if ($form->isSubmitted()) {
        // Deal with the submitted data

        $categoryRepository->save($category, true);
        $this->addFlash('success', 'Form submit success!');

        // Redirect to categories list

        return $this->redirectToRoute('category_new');
        // For example : persiste & flush the entity

        // And redirect to a route that display the result
    }

    // Render the form

    return $this->renderForm('category/new.html.twig', [
        'form' => $form,
    ]);
}
}
