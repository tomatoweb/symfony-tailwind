<?php

namespace App\Controller;

use App\Demo;
use App\Entity\Pool;
use App\Services\ArticleProvider;
use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\PoolRepository;
use App\Repository\ProfileRepository;
use App\Services\NewsApiProvider;
use App\Services\NewsProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ProfileController extends AbstractController
{
  // 1. Constructor property promotion
  // 2. injection de dépendance par le constructeur
  public function __construct(
      private ProfileRepository $repository,
      private PoolRepository $poolRepository,
      private EntityManagerInterface $em
  )
  {

  }


  #[Route('/profiles', name: 'profile.list')]                                            
  public function index(Request $request): Response   
  {

      /* Autre manière d'accéder à un service que via l'injection de dpdce: 
      via le container et son alias (donc pas par injection), 
      voir la commande debug:autowiring pour connaître les alias des services */
      $serviceForm = $this->container->get('form.factory'); // ok car le service est public, on peut y accéder par le container de Sf

      // $serviceValid = $this->container->get('validator');   // Error! car le service n'est pas public, on doit l'injecter par construction: soit dans la méthode (aka action), soit dans le constructeur

      // Attention: nota bene, l'instance retournée par le container est un singleton.
      // donc si on modifie une prop de l'instance dans une classe, cette prop est modifiée aussi dans les autres classes.
      // voir la config dans config/packages/knp_paginator.yaml
      $page = $request->query->getInt('page', 1);

      $limit = 8;
      
      $profiles = $this->repository->paginateProfiles($page, $limit);

      $maxPage = ceil($profiles->getTotalItemCount() / $limit);

      return $this->render('profile/index.html.twig', [
          'profiles' => $profiles,
          'maxPage' => $maxPage,
          'page' => $page
      ]);
  }



  #[Route('profile/edit/{id}', name:'profile.edit')]
  public function edit(Profile $profile, Request $request) {
  // Sf fait le find de manière implicite avec l'$id si on lui passe un type Profile en param
      $form = $this->createForm(ProfileType::class, $profile);
      $form->handleRequest($request);

      if($form->isSubmitted()){
          $this->em->flush();
          $this->addFlash('success', 'update ok!');
          return $this->redirectToRoute('profiles');
      }

      return $this->render('profile/edit.html.twig', [
          'profile' => $profile,
          'form' => $form
      ]);
  }


  #[Route('profile/create', name:'profile.create')]
  public function create(Request $request) {
      $profile = new Profile();
      $form = $this->createForm(ProfileType::class, $profile);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {

          $this->em->persist($profile);
          $this->em->flush();
          $this->addFlash('success', 'profile créé !');
          return $this->redirectToRoute('profiles');
      }

      return $this->render('profile/create.html.twig', [
          'form' => $form
      ]);
  }


  #[Route('profile/delete/{id}', name:'profile.delete')]
  public function delete(Profile $profile, Request $request) {

      $this->em->remove($profile);
      $this->em->flush();
      $this->addFlash('success', 'profile supprimé');

      return $this->redirectToRoute('profiles');
  }


  #[Route('/test', name: 'profile.test')]
  public function test(Request $request): Response
  {
      
  }
}