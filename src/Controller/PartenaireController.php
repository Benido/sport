<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartenaireController extends AbstractController
{

    #[Route(path: '/partenaire/{id}', name:'app_partenaire', methods: ['GET'])]
    public function partenaire(string $id, PartenaireRepository $partenaireRepo): Response
    {
        //On vérifie que l'utilisateur a bien le ROLE_CLIENT et que l'id du partenaire correspond
        if (!$this->isGranted('ROLE_ADMIN')) {
            $idPartenaire = (string) $this->getUser()->getPartenaire()->getId();
            if ($id !== $idPartenaire ) {
                return $this->redirectToRoute('app_home', array('error' => 'votre partenaire_id est :' . $idPartenaire));
            };
        }

        $partenaire = $partenaireRepo->find($id);
        // On récupère le tableau contenant toutes les instances de Structure reliées à l'instance Partenaire du client
        $structures = $partenaire->getStructures();
        $permissions = (array) json_decode($partenaire->getPermissions());

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('partenaire.html.twig', [
            'partenaire' => $partenaire,
            'structures' => $structures,
            'permissions' => $permissions
            ]);
    }

    #[Route(path: '/partenaire/{id}/permissions', name:'app_partenaire_permissions', methods: ['POST'])]
    public function editPartenairePermissions (string $id, Request $request, PartenaireRepository $partenaireRepository): Response
    {
        //On vérifie que l'utilisateur a bien le ROLE_CLIENT et que l'id du partenaire correspond
        if (!$this->isGranted('ROLE_ADMIN')) {
            $idPartenaire = (string) $this->getUser()->getPartenaire()->getId();
            if ($id !== $idPartenaire ) {
                return $this->redirectToRoute('app_home', array('error' => 'votre partenaire_id est :' . $idPartenaire));
            };
        }
        $permissions = $request->toArray();
        $partenaire = $partenaireRepository->find($id);
        $partenaire->setPermissions( json_encode($permissions));
        $partenaireRepository->save($partenaire, true);

        return new Response('Tout bon');
    }

    #[Route(path: '/partenaire/{id}/isactive', name:'app_partenaire_isactive', methods: ['POST'])]
    public function editPartenaireActiveState (string $id, Request $request, PartenaireRepository $partenaireRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            $idPartenaire = (string) $this->getUser()->getPartenaire()->getId();
            if ($id !== $idPartenaire ) {
                return $this->redirectToRoute('app_home', array('error' => 'votre partenaire_id est :' . $idPartenaire));
            };
        }
        //On requête la DB pour modifier le statut actif du partenaire. Ce nouveau statut s'appliquera également aux structures
        $isActive = $request->request->getBoolean('isActive');
        $partenaire = $partenaireRepository->find($id);
        $partenaire->setActive($isActive);
        $partenaireRepository->save($partenaire, true);

        $structures = $partenaire->getStructures();
        $permissions = (array) json_decode($partenaire->getPermissions());

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('partenaire.html.twig', [
            'partenaire' => $partenaire,
            'structures' => $structures,
            'permissions' => $permissions
        ]);
    }

}