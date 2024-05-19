<?php

namespace App\Controller;

use DateTimeZone;
use DateTimeImmutable;
use App\Entity\CdbRecipes;
use App\Form\CdbRecipesType;
use App\Services\ImageUploaderHelper;
use App\Repository\CdbRecipesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\CdbRecipesFeatured;

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

#[Route('/', name: 'app_set_featured_recipe', methods: ['POST'])]
public function setFeaturedRecipe(Request $request, EntityManagerInterface $entityManager): Response
{
    $featuredRecipeId = $request->request->getInt('featuredRecipeId');
    $cdbRecipesFeaturedRepository = $entityManager->getRepository(CdbRecipesFeatured::class);
    $featuredRecipe = $cdbRecipesFeaturedRepository->find(1); // Assuming the featured recipe is stored with ID 1

    if (!$featuredRecipe) {
        // Create a new instance if no featured recipe exists
        $featuredRecipe = new CdbRecipesFeatured();
        // Set any default values if needed
        // $featuredRecipe->setSomeProperty($defaultValue);
        // For example, if you have an ID property, set it here
        $featuredRecipe->setId(1); // Assuming ID 1
        // Persist the new instance
        $entityManager->persist($featuredRecipe);
    }

    // Set the "featured" value based on the clicked recipe ID
    $featuredRecipe->setFeatured($featuredRecipeId);
    $entityManager->flush();

    return $this->redirectToRoute('app_default_index');
}


    #[Route('/new', name: 'app_recipes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CdbRecipesRepository $cdbRecipesRepository, ImageUploaderHelper $imageUploaderHelper): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
            // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        $cdbRecipes = new CdbRecipes();
        $timeZone = new DateTimeZone('Europe/Paris');
        $cdbRecipes->setCreatedAt(new DateTimeImmutable('now', $timeZone));
        $cdbRecipes->setCreatedBy($this->getUser());

        $form = $this->createForm(CdbRecipesType::class, $cdbRecipes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $errorMessage = $imageUploaderHelper->uploadImage($form, $cdbRecipes);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $cdbRecipesRepository->save($cdbRecipes, true);

            return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipes/new.html.twig', [
            'cdb_recipes' => $cdbRecipes,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recipes_show', methods: ['GET'])]
    public function show(CdbRecipes $cdbRecipes): Response
    {
        return $this->render('recipes/show.html.twig', [
            'cdb_recipes' => $cdbRecipes,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recipes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CdbRecipes $cdbRecipes, CdbRecipesRepository $cdbRecipesRepository, ImageUploaderHelper $imageUploaderHelper): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
            // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        $form = $this->createForm(CdbRecipesType::class, $cdbRecipes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $errorMessage = $imageUploaderHelper->uploadImage($form, $cdbRecipes);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $cdbRecipesRepository->save($cdbRecipes, true);

            return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipes/edit.html.twig', [
            'cdb_recipes' => $cdbRecipes,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recipes_delete', methods: ['POST'])]
    public function delete(Request $request, CdbRecipes $cdbRecipes, CdbRecipesRepository $cdbRecipesRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
            // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        if ($this->isCsrfTokenValid('delete' . $cdbRecipes->getId(), $request->request->get('_token'))) {
            $cdbRecipesRepository->remove($cdbRecipes, true);
        }

        return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
    }
}