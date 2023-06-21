<?php

namespace App\Controller;

use DateTimeZone;
use DateTimeImmutable;
use App\Entity\CdbNews;
use App\Entity\CdbUsers;
use App\Form\CdbNewsType;
use Symfony\Component\Mime\Email;
use App\Repository\CdbNewsRepository;
use App\Services\ImageUploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/news')]
class NewsController extends AbstractController
{
    #[Route('/', name: 'app_news_index', methods: ['GET'])]
    public function index(CdbNewsRepository $cdbNewsRepository): Response
    {
        return $this->render('news/index.html.twig', [
            'cdb_news' => $cdbNewsRepository->findAll(),
        ]);
    }

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    #[Route('/new', name: 'app_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageUploaderHelper $imageUploaderHelper, CdbNewsRepository $cdbNewsRepository, MailerInterface $mailer): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
           // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        $cdbNews = new CdbNews();
        $timeZone = new DateTimeZone('Europe/Paris');
        $cdbNews->setCreatedAt(new DateTimeImmutable('now', $timeZone)); 
        $cdbNews->setCreatedBy($this->getUser());

        $form = $this->createForm(CdbNewsType::class, $cdbNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $errorMessage = $imageUploaderHelper->uploadImage($form, $cdbNews);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $cdbNewsRepository->save($cdbNews, true);

            // Récupérer tous les utilisateurs de la BD
            $userRepository = $this->entityManager->getRepository(CdbUsers::class);
            $users = $userRepository->findAll();
            
            // Envoyer un e-mail à chaque utilisateur de la BD
            foreach ($users as $user) {
                $email = (new Email())
                    ->from('mazurais.vincent@ik.me')
                    ->to($user->getEmail())
                    ->subject('Nouvelle news pour l\'épicerie "Cœur de bourg" !')
                    ->html('<p style="font-family: Arial, sans-serif;">Bonjour,</p><br><p style="font-family: Arial, sans-serif;">Une nouvelle news est disponible sur le site de l\'épicerie "<a href="http://192.168.1.32:8000" target="_blank">Cœur de bourg</a>" !</p><p style="font-family: Arial, sans-serif;">N\'hésitez pas à cliquer sur <a href="http://192.168.1.32:8000/news/' . $cdbNews->getId() . '" target="_blank">ce lien</a> pour aller la voir !</p><br><p style="font-family: Arial, sans-serif;">Bien à vous,<br>Épicerie "Cœur de bourg", Saint-Quentin-De-Caplong</p>');
                    // ->text("Bonjour,\n\n\nUne nouvelle news est disponible sur le site de l'épicerie \"Cœur de bourg\" !\n\nN'hésitez pas à cliquer sur le lien suivant pour aller la voir :\nhttp://192.168.1.32:8000/news/" . $cdbNews->getId() . "\n\n\nBien à vous,\nÉpicerie \"Cœur de bourg\"");
    
                $mailer->send($email);
            }

            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news/new.html.twig', [
            'cdb_news' => $cdbNews,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_show', methods: ['GET'])]
    public function show(CdbNews $cdbNews): Response
    {
        return $this->render('news/show.html.twig', [
            'cdb_news' => $cdbNews,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImageUploaderHelper $imageUploaderHelper, CdbNews $cdbNews, CdbNewsRepository $cdbNewsRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
           // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        $form = $this->createForm(CdbNewsType::class, $cdbNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errorMessage = $imageUploaderHelper->uploadImage($form, $cdbNews);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $cdbNewsRepository->save($cdbNews, true);

            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news/edit.html.twig', [
            'cdb_news' => $cdbNews,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_delete', methods: ['POST'])]
    public function delete(Request $request, CdbNews $cdbNews, CdbNewsRepository $cdbNewsRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
           // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        if ($this->isCsrfTokenValid('delete' . $cdbNews->getId(), $request->request->get('_token'))) {
            $cdbNewsRepository->remove($cdbNews, true);
        }

        return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    }
}