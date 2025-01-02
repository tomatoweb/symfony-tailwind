<?php

namespace App\Controller;

use App\Entity\Pool;
use App\Form\PoolType;
use App\Repository\PoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/pool', name: 'pool.')]
class PoolController extends AbstractController 
{
    public function __construct(private PoolRepository $repo, private EntityManagerInterface $em)
    {

    }

    #[Route('/', name: 'list')]
    public function list()
    {
        return $this->render('pool/list.html.twig', [
            'pools' => $this->repo->findAll()
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request)
    {
        $pool = new Pool();        
        $form = $this->createForm(PoolType::class, $pool);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($pool);
            $this->em->flush();
            $this->addFlash('success', 'Pool created.');
            return $this->redirectToRoute('pool.list');
        }

        return $this->render('pool/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route( '/update/{id}', name: 'update', requirements: [ 'id' => Requirement::DIGITS ] )]
    public function update(Pool $pool, Request $request)
    {
        $form = $this->createForm(PoolType::class, $pool);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Pool updated.');
            return $this->redirectToRoute('pool.list');
        }
        return $this->render('pool/update.html.twig', [
            'pool' => $pool, // for the title
            'form' => $form
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'])] // method delete not allowed --> form action in template + config/packages/framework  http_method_override true
    public function delete(Pool $pool)
    {
        
        $this->em->remove($pool);
        $this->em->flush();
        $this->addFlash('success', 'Pool deleted.');
        return $this->redirectToRoute('pool.list');
    }
}

