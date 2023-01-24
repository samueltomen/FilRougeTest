<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Form\ProjetsType;
use App\Repository\ProjetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    #[Route('/projets', name: 'app_projets')]
    public function index(ProjetsRepository $repository): Response
    {
        return $this->render('projet/index.html.twig', [
            'projets' => $repository->findAll(),
        ]);
    }

    #[Route('/projet/nouveau', 'projet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $projet = new Projets();
        $form = $this->createForm(ProjetsType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projet = $form->getData();
            $manager->persist($projet);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre projet à été créé avec succès'
            );

            return $this->redirectToRoute('app_projet');
        }

        return $this->render('projet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
