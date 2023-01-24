<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Form\ProjetsType;
use App\Repository\ProjetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $projet = new Projets();
        $form = $this->createForm(ProjetsType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $projet->setImage($newFilename);
            }
            $projet = $form->getData();
            $manager->persist($projet);
            $manager->flush();

            $this->addFlash('success', 'Votre projet à été créé avec succès');

            return $this->redirectToRoute('app_projets');
        }

        return $this->render('projet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[
        Route(
            '/projet/edition/{id}',
            name:'projet_edit',
            methods: ['GET', 'POST']
        )
    ]
    public function edit(ProjetsRepository $repository,Request $request,EntityManagerInterface $entityManager, int $id): Response
    {
        $projet = $repository->findOneBy(["id" => $id]);
        $form = $this->createForm(ProjetsType::class, $projet);
        return $this->render('projet/edit.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
