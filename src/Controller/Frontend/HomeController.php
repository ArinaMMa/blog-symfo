<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('', name: 'app.home', methods: ['GET'])]
    public function home(ArticleRepository $articleRepo): Response
    {
        return $this->render('Frontend/Home/index.html.twig', [
            'articles' => $articleRepo->findLatest(3),
        ]);
    }
}
