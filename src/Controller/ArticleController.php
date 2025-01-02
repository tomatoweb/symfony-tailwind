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
        
        $post = new Post();
        $post->setTitle('mon premier article');
        $post->setSlug('mon-premier-article');
        $post->setContent('mon contenu ici ...');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($post);
        $manager->flush();  

        $post = $manager->getRepository(Post::class)->findOrfailByTitle('mon premier article');
        
        $post = $repository->findOrfailByTitle('mon premier article');
        $post2 = $repository->findOrfailByTitle('mon premier article');
        dd($post === $post2);
        //$post->setSlug('mon-nouveau-slug');
        //$manager->flush();

        //dd($post); 

        /* $category = new Category(name: 'categorie #1');
        $category2 = new Category(name: 'categorie #2');
        $category3 = new Category(name: 'categorie #3');
        $manager->persist($category);
        $manager->persist($category2);
        $manager->persist($category3); */
        $posts = $repository->findAllWithCategory();
        //$post->setCategory($category);
        //$manager->flush();  
        

        $data = new ContactDTO();

        $form = $this->createForm(ContactType::class, $data);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dd($form->getData(), $data);
        }
        

        return $this->render('article/index.html.twig', [
            'articles' => $articles['articles'],
            'form' => $form,
            'posts' => $posts
        ]);
    }

    #[Route('/hello/{slug}', name: 'hello', requirements: ['slug' => Requirement::ASCII_SLUG])]
    public function hello(Request $request, string $slug): Response
    {
        return new Response($slug);        
    }
}
