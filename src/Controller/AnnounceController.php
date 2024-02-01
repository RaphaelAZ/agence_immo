<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Entity\PendingContact;
use App\Form\AnnounceFiltersType;
use App\Form\RecontactFormType;
use App\Repository\AnnounceRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AnnounceController extends AbstractController
{
    public function announcesList(AnnounceRepository $announceRepository, Request $request) {
        $form = $this->createForm(AnnounceFiltersType::class);
        $form->handleRequest($request);

        $announces = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $filters = $form->getData();
            $announces = $announceRepository->findByFilters($filters);
        }
        else {
            $announces = $announceRepository->findAll();
        }

        return $this->render('announces.html.twig', [
            'announces' => $announces,
            'form' => $form->createView(),
        ]);
    }

    public function uniqueAnnounce(ManagerRegistry $doctrine, int $id, EntityManagerInterface $em, Request $request) {
        $uniqueAnnounce = $doctrine->getRepository(Announce::class)->findOneBy(["id"=> $id]);
        $creationDate = $uniqueAnnounce->getCreation()->format("Y-m-d");

        $pendingContact = new PendingContact();
        $form = $this->createForm(RecontactFormType::class, $pendingContact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $pendingContact->setUser($user);
            $pendingContact->setAnnounce($uniqueAnnounce);
            $pendingContact->setDateContact(new DateTime());

            $em->persist($pendingContact);
            $em->flush();

            return $this->redirectToRoute('annonce', ['id' => $id, 'success' => "Demande de contact envoyé avec succès."]);
        }

        return $this->render('sale.html.twig',[
            'sale' => $uniqueAnnounce, 
            'creation' => $creationDate,
            'recontact_form' => $form
        ]);
    }

    public function homePage() {
        return $this->render('home.html.twig',[]);
    }

    public function favThis(ManagerRegistry $doctrine, $id) {
        var_dump($id);

        return $this->redirectToRoute('annonce', [
            'id' => $id,
        ]);
    }
}