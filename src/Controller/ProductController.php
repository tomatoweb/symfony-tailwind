<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
  #[Route('/', name: 'app_product')]
  public function index(
    Request $request, 
    ProductRepository $repo, 
    UserPasswordHasherInterface $hasher, 
    EntityManagerInterface $em
    ): Response
  {
     /* $user = new User();
    $user->setEmail('john4@doe.fr')
    ->setPassword($hasher
    ->hashPassword($user, '000000'))
    ->setRoles([]);
    $em->persist($user);
    $em->flush(); 
    dd($user); */
    //$this->denyAccessUnlessGranted('USER_ROLE');
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
