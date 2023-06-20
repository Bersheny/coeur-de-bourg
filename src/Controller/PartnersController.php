<?php

namespace App\Controller;

use DateTimeZone;
use DateTimeImmutable;
use App\Entity\CdbPartners;
use App\Form\CdbPartnersType;
use App\Services\ImageUploaderHelper;
use App\Repository\CdbPartnersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/partenaires')]
class PartnersController extends AbstractController
{
    #[Route('/', name: 'app_partners_index', methods: ['GET'])]
    public function index(CdbPartnersRepository $cdbPartnersRepository): Response
    {
        return $this->render('partners/index.html.twig', [
            'cdb_partners' => $cdbPartnersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_partners_new', methods: ['GET', 'POST'])]

    public function new(Request $request, ImageUploaderHelper $imageUploaderHelper, CdbPartnersRepository $cdbPartnersRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        }

        $cdbPartner = new CdbPartners();
        $timeZone = new DateTimeZone('Europe/Paris');
        $cdbPartner->setCreatedAt(new DateTimeImmutable('now', $timeZone));
        $cdbPartner->setCreatedBy($this->getUser());

        $form = $this->createForm(CdbPartnersType::class, $cdbPartner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $errorMessage = $imageUploaderHelper->uploadImage($form, $cdbPartner);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $cdbPartnersRepository->save($cdbPartner, true);

            return $this->redirectToRoute('app_partners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partners/new.html.twig', [
            'cdb_partners' => $cdbPartner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partners_show', methods: ['GET'])]
    public function show(CdbPartners $cdbPartner): Response
    {
        return $this->render('partners/show.html.twig', [
            'cdb_partners' => $cdbPartner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_partners_edit', methods: ['GET', 'POST'])]

    public function edit(Request $request, ImageUploaderHelper $imageUploaderHelper, CdbPartners $cdbPartner, CdbPartnersRepository $cdbPartnersRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        }

        $form = $this->createForm(CdbPartnersType::class, $cdbPartner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errorMessage = $imageUploaderHelper->uploadImage($form, $cdbPartner);
            if (!empty($errorMessage)) {
                $this->addFlash('danger', 'Une erreur s\'est produite : ' . $errorMessage);
            }
            $cdbPartnersRepository->save($cdbPartner, true);

            return $this->redirectToRoute('app_partners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partners/edit.html.twig', [
            'cdb_partners' => $cdbPartner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partners_delete', methods: ['POST'])]
    public function delete(Request $request, CdbPartners $cdbPartner, CdbPartnersRepository $cdbPartnersRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        }

        if ($this->isCsrfTokenValid('delete'.$cdbPartner->getId(), $request->request->get('_token'))) {
            $cdbPartnersRepository->remove($cdbPartner, true);
        }

        return $this->redirectToRoute('app_partners_index', [], Response::HTTP_SEE_OTHER);
    }
}
