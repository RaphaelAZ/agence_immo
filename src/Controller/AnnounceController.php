<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Form\AnnounceFiltersType;
use App\Repository\AnnounceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

    public function uniqueAnnounce(ManagerRegistry $doctrine, int $id) {
        $uniqueAnnounce = $doctrine->getRepository(Announce::class)->findOneBy(["id"=> $id]);
        $creationDate = $uniqueAnnounce->getCreation()->format("Y-m-d");
        return $this->render('sale.html.twig',['sale' => $uniqueAnnounce, 'creation' => $creationDate]);
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