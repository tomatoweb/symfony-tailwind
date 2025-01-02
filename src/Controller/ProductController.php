<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
  #[Route('/', name: 'app_product')]
  public function index(Request $request, ProductRepository $repo): Response
  {
    $page = $request->query->getInt('page', 1);
    $limit = 8;
    $products = $repo->paginateProducts($page, $limit);
    $maxPage = ceil($products->getTotalItemCount() / $limit);

      return $this->render('product/index.html.twig', [
          'products' => $products,
          'maxPage' => $maxPage,
          'page' => $page
      ]);
  }
}
