<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartenaireController extends AbstractController
{
    #[Route(path: '/partenaire/{id}', name:'app_partenaire')]
    public function partenaire(string $id, PartenaireRepository $partenaireRepo): Response
    {
        //On vérifie que l'utiliseur a bien le ROLE_CLIENT et que l'id du partenaire correspond
        if (!$this->isGranted('ROLE_ADMIN')) {
            $idPartenaire = (string) $this->getUser()->getPartenaire()->getId();
            if ($id !== $idPartenaire ) {
                return $this->redirectToRoute('app_home', array('error' => 'votre partenaire_id est :' . $idPartenaire));
            };
        }

        $partenaire = $partenaireRepo->find($id);
        // On récupère le tableau contenant toutes les instances de Structure reliées à l'instance Partenaire du client
        $structures = $partenaire->getStructures();

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('partenaire.html.twig', [
            'partenaire' => $partenaire,
            'structures' => $structures
            ]);
    }

}