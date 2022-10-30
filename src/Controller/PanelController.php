<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PartenaireRepository;


class PanelController extends AbstractController
{

    #[Route(path: '/panel', name: 'app_panel')]
    public function panel(PartenaireRepository $partenaireRepo) {
        // Nous générons du contenu pour notre réponse
        $partenaires = $partenaireRepo->findAll();

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('panel.html.twig', [
            'partenaires' => $partenaires
        ]);
    }
}