<?php

namespace App\Controller;

use App\Entity\CdbRecipes;
use App\Form\CdbRecipes1Type;
use App\Repository\CdbRecipesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/recettes')]
class RecipesController extends AbstractController
{
    #[Route('/', name: 'app_recipes_index', methods: ['GET'])]
    public function index(CdbRecipesRepository $cdbRecipesRepository): Response
    {
        return $this->render('recipes/index.html.twig', [
            'cdb_recipes' => $cdbRecipesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recipes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CdbRecipesRepository $cdbRecipesRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
           // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }
        
        $cdbRecipe = new CdbRecipes();
        $form = $this->createForm(CdbRecipes1Type::class, $cdbRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdbRecipesRepository->save($cdbRecipe, true);

            return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipes/new.html.twig', [
            'cdb_recipe' => $cdbRecipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recipes_show', methods: ['GET'])]
    public function show(CdbRecipes $cdbRecipe): Response
    {
        return $this->render('recipes/show.html.twig', [
            'cdb_recipe' => $cdbRecipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recipes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CdbRecipes $cdbRecipe, CdbRecipesRepository $cdbRecipesRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
           // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        $form = $this->createForm(CdbRecipes1Type::class, $cdbRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdbRecipesRepository->save($cdbRecipe, true);

            return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipes/edit.html.twig', [
            'cdb_recipe' => $cdbRecipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recipes_delete', methods: ['POST'])]
    public function delete(Request $request, CdbRecipes $cdbRecipe, CdbRecipesRepository $cdbRecipesRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
           // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        if ($this->isCsrfTokenValid('delete'.$cdbRecipe->getId(), $request->request->get('_token'))) {
            $cdbRecipesRepository->remove($cdbRecipe, true);
        }

        return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
    }
}
