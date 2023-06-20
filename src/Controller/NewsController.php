<?php

namespace App\Controller;

use DateTimeZone;
use DateTimeImmutable;
use App\Entity\CdbNews;
use App\Form\CdbNewsType;
use App\Repository\CdbNewsRepository;
use App\Services\ImageUploaderHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/new', name: 'app_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageUploaderHelper $imageUploaderHelper, CdbNewsRepository $cdbNewsRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        }

        if ($this->isCsrfTokenValid('delete' . $cdbNews->getId(), $request->request->get('_token'))) {
            $cdbNewsRepository->remove($cdbNews, true);
        }

        return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    }
}