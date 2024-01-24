<?php

namespace App\Controller;

use App\Form\UserLoginFormType;
use App\Form\UserRegisterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'connexion')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(UserLoginFormType::class);

        return $this->render('security/login.html.twig', ['form' => $form->createView(),'error' => $error,]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function register(Request $request): Response
    {
        $form = $this->createForm(UserRegisterFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form->setData($form->getData());

            return $this->redirectToRoute('accueil');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
