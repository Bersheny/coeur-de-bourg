<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Entity\CdbRecipesFeatured;
use Symfony\Component\Mailer\Mailer;
use App\Repository\CdbNewsRepository;
use Symfony\Component\Mailer\Transport;
use App\Repository\CdbRecipesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CdbRecipesFeaturedRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default_index')]
    public function index(Request $request, CdbNewsRepository $cdbNewsRepository, CdbRecipesFeaturedRepository $cdbRecipesFeaturedRepository, CdbRecipesRepository $cdbRecipesRepository)
    {
        // Retrieve the featured recipe entity by ID from the repository
        $featuredRecipe = $cdbRecipesFeaturedRepository->find(1);

        // Retrieve the "featured" value of the featured recipe entity
        $featuredValue = ($featuredRecipe) ? $featuredRecipe->getFeatured() : false;

        return $this->render('default/index.html.twig', [
            'cdb_news' => $cdbNewsRepository->findAll(),
            'cdb_recipes' => $cdbRecipesRepository->findAll(),
            'featuredValue' => $featuredValue,
        ]);
    }

    public function sendEmail(Request $request, MailerInterface $mailer)
    {
        $first_name = $request->request->get('first_name');
        $last_name = $request->request->get('last_name');
        $email = $request->request->get('email');
        $phone_number = $request->request->get('phone_number');
        $subject = $request->request->get('subject');
        $message = $request->request->get('message');

        $email = (new Email())
            ->from('mazurais.vincent@ik.me')
            ->to('mazurais.vincent@ik.me')
            ->subject($subject)
            ->text("Ce mail provient du formulaire de contact du site Internet 'epicerie-coeur-de-bourg.fr'\n\nLes informations fournies peuvent être erronées ou ne pas correspondres aux coordonnées réelles de la personne ayant envoyé ce message, l'auteur de ce message peut donc se faire passer pour quelqu'un d'autre !\n\n\nNom : $last_name\n\nPrénom : $first_name\n\nEmail : $email\n\nTéléphone : $phone_number\n\nSujet : $subject\n\n\n\n$message");

        $mailer->send($email);

        // Add a flash message to indicate success
        $this->addFlash('success', 'Le message a bien été envoyé, nous vous recontacterons par mail ou par téléphone le plus vite possible !');

        return new RedirectResponse($this->generateUrl('app_default_index'));
    }
}