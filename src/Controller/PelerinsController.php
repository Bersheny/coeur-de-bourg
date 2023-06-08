<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PelerinsController extends AbstractController
{
    #[Route('/pelerins', name: 'app_pelerins_index')]
    public function index()
    {
        return $this->render('pelerins/index.html.twig');
    }
}