<?php

namespace App\Controller;

use App\Entity\CdbUsers;
use App\Form\CdbUsersType;
use App\Repository\CdbUsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/users')]
class UsersController extends AbstractController
{
    #[Route('/', name: 'app_users_index', methods: ['GET'])]
    public function index(CdbUsersRepository $cdbUsersRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
           // Si non, vérifie si l'utilisateur a le rôle ROLE_MODERATOR
            if (!$this->isGranted('ROLE_MODERATOR')) {
                // Si l'utilisateur n'a aucun rôle, refuser l'accès
                throw new AccessDeniedException('Vous n\'avez pas accès à cette page');
            }
        }

        return $this->render('users/index.html.twig', [
            'cdb_users' => $cdbUsersRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_users_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, CdbUsersRepository $cdbUsersRepository): Response
    // {
    //     $cdbUser = new CdbUsers();
    //     $form = $this->createForm(CdbUsersType::class, $cdbUser);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $cdbUsersRepository->save($cdbUser, true);

    //         return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('users/new.html.twig', [
    //         'cdb_user' => $cdbUser,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_users_show', methods: ['GET'])]
    // public function show(CdbUsers $cdbUser): Response
    // {
    //     return $this->render('users/show.html.twig', [
    //         'cdb_user' => $cdbUser,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_users_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, CdbUsers $cdbUser, CdbUsersRepository $cdbUsersRepository): Response
    // {
    //     $form = $this->createForm(CdbUsersType::class, $cdbUser);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $cdbUsersRepository->save($cdbUser, true);

    //         return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('users/edit.html.twig', [
    //         'cdb_user' => $cdbUser,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_users_delete', methods: ['POST'])]
    public function delete(Request $request, CdbUsers $cdbUser, CdbUsersRepository $cdbUsersRepository): Response
    {
        // Vérifie si l'utilisateur a le rôle ROLE_ADMIN, sinon l'accès est refusé
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$cdbUser->getId(), $request->request->get('_token'))) {
            $cdbUsersRepository->remove($cdbUser, true);
        }

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }
}
