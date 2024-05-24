<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app.articles')]
    public function index(ArticleRepository $articleRepo): Response
    {
        return $this->render('Frontend/Articles/index.html.twig', [
            'articles' => $articleRepo->findEnable(),
        ]);
    }
}
