<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Form\MarkType;
use App\Entity\Projets;
use App\Form\ProjetsType;
use App\Repository\MarkRepository;
use App\Repository\ProjetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProjetController extends AbstractController
{
    #[Route('/projets', name: 'app_projets')]
    public function index(ProjetsRepository $repository): Response
    {
        return $this->render('projet/index.html.twig', [
            'projets' => $repository->findAll(),
        ]);
    }

    // #[IsGranted('ROLE_ADMIN')]
    #[Route('/projet/nouveau', 'projet_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $projets = new Projets();
        $form = $this->createForm(ProjetsType::class, $projets);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo(
                    $imageFile->getClientOriginalName(),
                    PATHINFO_FILENAME
                );
                $safeFilename = transliterator_transliterate(
                    'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
                    $originalFilename
                );
                $newFilename =
                    $safeFilename .
                    '-' .
                    uniqid() .
                    '.' .
                    $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $projets->setImage($newFilename);
            }
            $projets = $form->getData();
            $manager->persist($projets);
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
            name: 'projet_edit',
            methods: ['GET', 'POST']
        )
    ]
    public function edit(
        Projets $projets,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(ProjetsType::class, $projets);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo(
                    $imageFile->getClientOriginalName(),
                    PATHINFO_FILENAME
                );
                $safeFilename = transliterator_transliterate(
                    'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
                    $originalFilename
                );
                $newFilename =
                    $safeFilename .
                    '-' .
                    uniqid() .
                    '.' .
                    $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $projets->setImage($newFilename);
            }
            $projets = $form->getData();
            $manager->persist($projets);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre projet à été modifié avec succès'
            );

            return $this->redirectToRoute('app_projets');
        }

        $form = $this->createForm(ProjetsType::class, $projets);

        return $this->render('projet/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/projet/delete/{id}', name: 'projet_delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Projets $projets
    ): Response {
        $manager->remove($projets);
        $manager->flush();

        $this->addFlash('danger', 'Votre projet à été supprimé');
        return $this->redirectToRoute('app_projets');
    }

    #[
        Route(
            '/projet/{id}',
            name: 'app_projet_description',
            methods: ['GET', 'POST']
        )
    ]
    public function projetsShow(
        Projets $projets,
        Request $request,
        MarkRepository $markRepository,
        EntityManagerInterface $manager
    ): Response {
        $mark = new Mark();
        $form = $this->createForm(MarkType::class, $mark);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mark->setUser($this->getUser())->setProjet($projets);
            $existingMark = $markRepository->findOneBy([
                'user' => $this->getUser(),
                'projet' => $projets,
            ]);
            if (!$existingMark) {
                $manager->persist($mark);
            } else {
                $existingMark->setMark($form->getData()->getMark());
            }

            $manager->flush();

            $this->addFlash('success', 'Votre note a bien été prise en compte');

            return $this->redirectToRoute('app_projet_description', [
                'id' => $projets->getId(),
            ]);
        }

        return $this->render('projet/show.html.twig', [
            'projet' => $projets,
            'form' => $form->createView(),
        ]);
    }
}
