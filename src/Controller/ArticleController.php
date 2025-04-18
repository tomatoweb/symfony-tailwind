<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Entity\Category;
use App\Entity\Post;
use App\Form\ContactType;
use App\Repository\PostRepository;
use App\Services\ArticleApiProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class ArticleController extends AbstractController
{
    public function __construct() 
    {        
    }

    #[Route('/posts', name: 'app_articles')]
    public function index(Request $request, EntityManagerInterface $manager, PostRepository $repository): Response
    {       
      
        /* 
        *  Testing DB area 
        */

        /* $post = new Post();
        $post->setTitle('my first post');
        $post->setSlug('my-first-post');
        $post->setContent('my content here ...');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($post);
        $manager->flush();  

        $post = $manager->getRepository(Post::class)->findOrfailByTitle('mon premier article');
        
        $post = $repository->findOrfailByTitle('my first post');
        $post2 = $repository->findOrfailByTitle('my first post');
        dump($post === $post2); // true
        $post->setSlug('my-new-slug');
        $manager->flush();

        dump($post); 

        $category = new Category(name: 'development');
        $category2 = new Category(name: 'mobile');
        $category3 = new Category(name: 'computer');
        $manager->persist($category);
        $manager->persist($category2);
        $manager->persist($category3); 
        $manager->flush();
        $posts = $repository->findAllWithCategory();
        $post->setCategory($category);
        $manager->flush();  
        dd($posts); */
        
        /* le but des DTO est de déplacer des données dans des appels distants (web api) coûteux */
        $data = new ContactDTO();

        $form = $this->createForm(ContactType::class, $data);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dd($form->getData());
        }
        
        $posts = $repository->findAll();

        return $this->render('article/index.html.twig', [
            'form' => $form,
            'posts' => $posts
        ]);
    }
}
