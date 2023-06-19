<?php

namespace App\Controller;

use App\Entity\CdbPartners;
use App\Form\CdbPartnersType;
use App\Repository\CdbPartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cdb/partners')]
class CdbPartnersController extends AbstractController
{
    #[Route('/', name: 'app_cdb_partners_index', methods: ['GET'])]
    public function index(CdbPartnersRepository $cdbPartnersRepository): Response
    {
        return $this->render('cdb_partners/index.html.twig', [
            'cdb_partners' => $cdbPartnersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cdb_partners_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CdbPartnersRepository $cdbPartnersRepository): Response
    {
        $cdbPartner = new CdbPartners();
        $form = $this->createForm(CdbPartnersType::class, $cdbPartner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdbPartnersRepository->save($cdbPartner, true);

            return $this->redirectToRoute('app_cdb_partners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cdb_partners/new.html.twig', [
            'cdb_partner' => $cdbPartner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cdb_partners_show', methods: ['GET'])]
    public function show(CdbPartners $cdbPartner): Response
    {
        return $this->render('cdb_partners/show.html.twig', [
            'cdb_partner' => $cdbPartner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cdb_partners_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CdbPartners $cdbPartner, CdbPartnersRepository $cdbPartnersRepository): Response
    {
        $form = $this->createForm(CdbPartnersType::class, $cdbPartner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdbPartnersRepository->save($cdbPartner, true);

            return $this->redirectToRoute('app_cdb_partners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cdb_partners/edit.html.twig', [
            'cdb_partner' => $cdbPartner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cdb_partners_delete', methods: ['POST'])]
    public function delete(Request $request, CdbPartners $cdbPartner, CdbPartnersRepository $cdbPartnersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cdbPartner->getId(), $request->request->get('_token'))) {
            $cdbPartnersRepository->remove($cdbPartner, true);
        }

        return $this->redirectToRoute('app_cdb_partners_index', [], Response::HTTP_SEE_OTHER);
    }
}
