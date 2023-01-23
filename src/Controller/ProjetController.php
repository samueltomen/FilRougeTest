<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Form\ProjetsType;
use App\Repository\ProjetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/projet/nouveau', 'projet.new', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        $projet = new Projets();
        $form = $this->createForm(ProjetsType::class, $projet);
        return $this->render('projet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
