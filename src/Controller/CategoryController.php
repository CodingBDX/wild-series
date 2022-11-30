<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

     #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
     public function show(string $categoryName, CategoryRepository $categoryRepository): Response
     {
         $category = $categoryRepository->findOneBy(['name' => $categoryName]);

         if (!$category) {
             throw $this->createNotFoundException(
                 'No category with id : '.$categoryName.' found in categorie\'s table.'
             );
         }

         return $this->render('category/show.html.twig', ['category' => $category]);
     }
}
