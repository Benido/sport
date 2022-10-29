<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanelController extends AbstractController
{

    #[Route(path: '/panel')]
    public function panel() {
        // Nous générons du contenu pour notre réponse
        $helloPanel = 'Ici c\'est le panel';

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('panel.html.twig', ['helloPanel' => $helloPanel]);
    }
}