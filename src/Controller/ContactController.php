<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Entity\Contact;
use App\Form\SendContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function contactInitialization(Request $request, ManagerRegistry $doctrine) {
        $contact = new Contact();
        $form = $this->createForm(SendContactType::class, $contact);

        $contact->setDatePost(new \DateTime());

        var_dump($contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $receiver = "razevedo@myges.fr";
            $sujet = "OBJET";
            $message = "MESSAGE";
            $headers = "From: "."EMAIL"."";
            $mail_success = mail($receiver, $sujet, $message, $headers); //TODO CORRIGER LE SERVEUR SMTP

            if ($mail_success) {
                return $this->render('contact.html.twig',['success'=>"L'e-mail a été envoyé avec succès !"]);
            } else {
                return $this->render('contact.html.twig',['error'=>"Erreur lors de l'envoi de l'e-mail."]);
            }
        }

        return $this->render('contact.html.twig',['form' => $form->createView()]);
    }
}