<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Attribute\Route;

class PublishController extends AbstractController
{
    /* Mercure Protocol */
    #[Route('/publish', name: 'publish')]
    public function publish(HubInterface $hub): Response
    {
        $update = new Update(
            'https://example.com/books/1',
            json_encode(['status' => 'This is an update from backend server'])
        );

        $hub->publish($update);

        return new Response('published!');
    }
}