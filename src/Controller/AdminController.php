<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Form\AnnounceCreateFormType;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
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
    public function dashboardCreateAnnounce(Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(AnnounceCreateFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $announce = new Announce();
            $file = $form['image']->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $announce->setImage($fileName);
            $announce->setTitle($form->get('title')->getData());
            $announce->setDescription($form->get('description')->getData());
            $announce->setLocation($form->get('location')->getData());
            $announce->setPrice($form->get('price')->getData());
            $announce->setSurface($form->get('surface')->getData());
            $announce->setType($form->get('type')->getData());
            $announce->setCreation(new DateTime());

            $em->persist($announce);
            $em->flush();

            return $this->render('admin/dashboard-create-announce.html.twig', ['form' => $form->createView(),'success' => "Annonce créée avec succès."]);
        }

        return $this->render('admin/dashboard-create-announce.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/panel/supprimeruneannonce/{id}', name: 'panel/supprimeruneannonce')]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboardDeleteAnnounce($id, EntityManagerInterface $em) {
        // $announce = $em->getRepository(Announce::class)->find($id);

        // $em->remove($announce);
        // $em->flush();

        $announcesList = $em->getRepository(Announce::class)->findAll();

        return $this->redirectToRoute('panel_admin', [
            'announces' => $announcesList,
        ]);
    }

    #[Route('/panel/editeruneannonce/{id}', name: 'panel/editeruneannonce')]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboardEditAnnounce(Request $request, EntityManagerInterface $em, $id) {
        $announce = $em->getRepository(Announce::class)->find($id);

        // Vérifier si l'annonce existe
        if (!$announce) {
            throw $this->createNotFoundException('Annonce non trouvée pour l\'id '.$id);
        }

        $ancienneImage = $announce->getImage();

        $form = $this->createForm(AnnounceCreateFormType::class, $announce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            if ($file) {
                // Gérer le téléchargement de la nouvelle image seulement si elle a été modifiée
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $announce->setImage($fileName);

                if ($ancienneImage) {
                    $cheminAncienneImage = $this->getParameter('images_directory') . '/' . $ancienneImage;
                
                    $filesystem = new Filesystem();
                
                    if ($filesystem->exists($cheminAncienneImage)) {
                        $filesystem->remove([$cheminAncienneImage]);
                    }
                }
            }

            // Mettre à jour les autres propriétés de l'annonce avec les données du formulaire
            $announce->setTitle($form->get('title')->getData());
            $announce->setDescription($form->get('description')->getData());
            $announce->setLocation($form->get('location')->getData());
            $announce->setPrice($form->get('price')->getData());
            $announce->setSurface($form->get('surface')->getData());
            $announce->setType($form->get('type')->getData());
            $announce->setCreation(new DateTime());

            $em->flush();

            return $this->render('admin/dashboard-update-announce.html.twig', ['form' => $form->createView(), 'success' => "Annonce modifiée avec succès."]);
        }

        return $this->render('admin/dashboard-update-announce.html.twig', ['form' => $form->createView()]);
    }
}
