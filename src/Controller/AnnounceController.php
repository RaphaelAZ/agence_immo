<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Repository\AnnounceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnounceController extends AbstractController
{
    public function announcesList(ManagerRegistry $doctrine) {
        $announces = $doctrine->getRepository(Announce::class)->findAll();
        return $this->render('announces.html.twig',['announces' => $announces,]);
    }

    public function uniqueAnnounce(ManagerRegistry $doctrine, int $id) {
        $uniqueAnnounce = $doctrine->getRepository(Announce::class)->findOneBy(["id"=> $id]);
        $creationDate = $uniqueAnnounce->getCreation()->format("Y-m-d");
        return $this->render('sale.html.twig',['sale' => $uniqueAnnounce, 'creation' => $creationDate]);
    }

    public function homePage() {
        return $this->render('home.html.twig',[]);
    }

    #[Route('/favorite/{id}', name: 'inscription')]
    public function favoriteThis($id) {
        var_dump($id);
    }
}