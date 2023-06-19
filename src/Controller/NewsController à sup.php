<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\TblNews;
use App\Form\TblNewsType;
use App\Repository\TblNewsRepository;
use App\Services\ImageUploaderHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/newsCOPY')]
class NewsController extends AbstractController
{
    #[Route('/', name: 'app_news_index', methods: ['GET'])]
    public function index(TblNewsRepository $tblNewsRepository): Response
    {
        return $this->render('news/index.html.twig', [
            'tbl_news' => $tblNewsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageUploaderHelper $imageUploaderHelper, TblNewsRepository $tblNewsRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        }

        $tblNews = new TblNews();
        $tblNews->setCreatedAt(new DateTimeImmutable());

        $form = $this->createForm(TblNewsType::class, $tblNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $errorMessage = $imageUploaderHelper->uploadImage($form, $tblNews);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $tblNewsRepository->save($tblNews, true);

            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news/new.html.twig', [
            'tbl_news' => $tblNews,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_show', methods: ['GET'])]
    public function show(TblNews $tblNews): Response
    {
        return $this->render('news/show.html.twig', [
            'tbl_news' => $tblNews,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImageUploaderHelper $imageUploaderHelper, TblNews $tblNews, TblNewsRepository $tblNewsRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        }

        $form = $this->createForm(TblNewsType::class, $tblNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errorMessage = $imageUploaderHelper->uploadImage($form, $tblNews);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $tblNewsRepository->save($tblNews, true);

            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news/edit.html.twig', [
            'tbl_news' => $tblNews,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_delete', methods: ['POST'])]
    public function delete(Request $request, TblNews $tblNews, TblNewsRepository $tblNewsRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        }

        if ($this->isCsrfTokenValid('delete' . $tblNews->getId(), $request->request->get('_token'))) {
            $tblNewsRepository->remove($tblNews, true);
        }

        return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    }
}