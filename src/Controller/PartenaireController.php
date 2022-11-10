<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartenaireController extends AbstractController
{

    #[Route(path: '/partenaire/{id}', name:'app_partenaire', methods: ['GET'])]
    public function partenaire(string $id, PartenaireRepository $partenaireRepo): Response
    {
        // On vérifie que l'utilisateur a bien le ROLE_CLIENT et que l'id du partenaire correspond
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
        // On vérifie que l'utilisateur a bien le ROLE_CLIENT et que l'id du partenaire correspond
        if (!$this->isGranted('ROLE_ADMIN')) {
            $idPartenaire = (string) $this->getUser()->getPartenaire()->getId();
            if ($id !== $idPartenaire ) {
                return $this->redirectToRoute('app_home', array('error' => 'votre partenaire_id est :' . $idPartenaire));
            };
        }
        // On récupère l'objet permissions en JSON depuis la requête, et on le passe au partenaire correspondant à l'id
        $permissions = $request->toArray();
        $partenaire = $partenaireRepository->find($id);
        $partenaire->setPermissions(json_encode($permissions));
        $partenaireRepository->save($partenaire, true);

        return new Response('Permission modifiée pour '. $partenaire->getFranchiseName(), 200);
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
        //On modifie le statut actif du partenaire dans la DB.
        $isActive = $request->request->getBoolean('isActive');
        $partenaire = $partenaireRepository->find($id);
        $partenaire->setActive($isActive);
        $partenaireRepository->save($partenaire, true);

        //Ce nouveau statut s'appliquera également aux structures
        $structures = $partenaire->getStructures();
        foreach ($structures as $structure) {
            $structure->setActive($isActive);
        }
        $permissions = (array) json_decode($partenaire->getPermissions());

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('partenaire.html.twig', [
            'partenaire' => $partenaire,
            'structures' => $structures,
            'permissions' => $permissions
        ]);
    }

}