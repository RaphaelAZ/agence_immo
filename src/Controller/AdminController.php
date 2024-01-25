<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/panel', name: 'panel')]
    #[Route('/panel/annonces', name: 'panel/annonces')]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboardAnnounces(EntityManagerInterface $doctrine) {

        $announcesList = $doctrine->getRepository(Announce::class)->findAll();

        return $this->render('admin/dashboard-announces.html.twig', [
            'announces' => $announcesList,
        ]);
    }

    #[Route('/panel/utilisateurs', name: 'panel/utilisateurs')]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboardUsers(UserRepository $userRepository) {
        $users = $userRepository->getInformationsForAdmins();

        return $this->render('admin/dashboard-users.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/panel/creeruneannonce', name: 'panel/creeruneannonce')]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboardCreateAnnounce(UserRepository $userRepository) {
        $users = $userRepository->getInformationsForAdmins();

        return $this->render('admin/dashboard-create-announce.html.twig', []);
    }
}
