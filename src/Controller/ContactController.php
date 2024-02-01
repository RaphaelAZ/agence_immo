<?php

namespace App\Controller;

use App\Form\SendContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    public function contactInitialization(Request $request, MailerInterface $mailer) {

        $form = $this->createForm(SendContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from($form->getData()['email'])
                ->to('azera.immo@gmail.com')
                ->subject($form->getData()['subject'])
                ->text($form->getData()['message']);

            if ($mailer->send($email)) {
                header('Location: /accueil');
            }  
        }

        return $this->render('contact.html.twig',['form' => $form->createView()]);
    }
}