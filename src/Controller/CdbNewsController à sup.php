<?php

namespace App\Controller;

use App\Entity\CdbNews;
use App\Form\CdbNewsType;
use App\Repository\CdbNewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cdb/news')]
class CdbNewsController extends AbstractController
{
    #[Route('/', name: 'app_cdb_news_index', methods: ['GET'])]
    public function index(CdbNewsRepository $cdbNewsRepository): Response
    {
        return $this->render('cdb_news/index.html.twig', [
            'cdb_news' => $cdbNewsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cdb_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CdbNewsRepository $cdbNewsRepository): Response
    {
        $cdbNews = new CdbNews();
        $form = $this->createForm(CdbNewsType::class, $cdbNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdbNewsRepository->save($cdbNews, true);

            return $this->redirectToRoute('app_cdb_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cdb_news/new.html.twig', [
            'cdb_news' => $cdbNews,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cdb_news_show', methods: ['GET'])]
    public function show(CdbNews $cdbNews): Response
    {
        return $this->render('cdb_news/show.html.twig', [
            'cdb_news' => $cdbNews,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cdb_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CdbNews $cdbNews, CdbNewsRepository $cdbNewsRepository): Response
    {
        $form = $this->createForm(CdbNewsType::class, $cdbNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdbNewsRepository->save($cdbNews, true);

            return $this->redirectToRoute('app_cdb_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cdb_news/edit.html.twig', [
            'cdb_news' => $cdbNews,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cdb_news_delete', methods: ['POST'])]
    public function delete(Request $request, CdbNews $cdbNews, CdbNewsRepository $cdbNewsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cdbNews->getId(), $request->request->get('_token'))) {
            $cdbNewsRepository->remove($cdbNews, true);
        }

        return $this->redirectToRoute('app_cdb_news_index', [], Response::HTTP_SEE_OTHER);
    }
}
