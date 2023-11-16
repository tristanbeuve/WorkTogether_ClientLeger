<?php

namespace App\Controller;

use App\Dto\RegisterDto;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
//    public function author(): Response
//    {
//        $user = new User();
//
//        // ... do something to the $author object
//
//
//    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, RegisterDto $dto ,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $dataUser = new RegisterDto();
        $form = $this->createForm(RegistrationFormType::class, $dataUser);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
//            dump($user);

            $user->setEmail($dataUser->email);
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $dataUser->password
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home', [

            ]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
