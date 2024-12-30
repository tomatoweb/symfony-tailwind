<?php

namespace App\Controller;

use App\Services\NewsApiProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index( NewsApiProvider $provider ): Response
    {

        $response = $provider->getNews();
        $news = $response['articles'];

        return $this->render('news/index.html.twig', [
            'news' => $news,
        ]);
    }
}
