<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    #[
        Route(
            '/utilisateur/edition/{id}',
            name: 'app_user',
            methods: ['GET', 'POST']
        )
    ]
    
    public function index(
        User $user,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_user');
        }
        

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (
                $hasher->isPasswordValid(
                    $user,
                    $form->getData()->getPlainPassword()
                )
            ) {
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Vos informations ont bien été modifiés '
                );
                return $this->redirectToRoute('app_projets');
            } else {
                $this->addFlash('danger', 'Le mot de passe est incorrect');
            }
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[
        Route(
            '/utilisateur/edition-mot-de-passe/{id}',
            'app_user_password',
            methods: ['GET', 'POST']
        )
    ]
    public function editPassword(
        User $user,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {
        $form = $this->createForm(UserPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (
                $hasher->isPasswordValid(
                    $user,
                    $form->getData()->getPlainPassword()
                )
            ) {
                $user->setCreatedAt(new \DateTimeImmutable());
                $user->setPlainPassword($form->get('newPassword')->getData());

                $this->addFlash(
                    'success',
                    'Le mot de passe a bien été modifié'
                );
                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('warning', 'Le mot de passe est incorrect');
            }
        }
        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[
        Route(
            '/utilisateur/mon-compte/{id}',
            name: 'app_account',
            methods: ['GET', 'POST']
        )
    ]
    
    public function account(
        User $user,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {
        
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/account_user.html.twig');
    }
}
