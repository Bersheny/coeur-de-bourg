<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartenairesController extends AbstractController
{
    #[Route('/partenaires', name: 'app_partenaires_index')]
    public function index()
    {
        return $this->render('partenaires/index.html.twig');
    }
}