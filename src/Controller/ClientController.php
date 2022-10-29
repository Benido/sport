<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route(path: '/client', name:'app_client')]
    public function client() {
        // Nous générons du contenu pour notre réponse
        $helloClient = 'Ici c\'est la vue partenaire';

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('client.html.twig', ['helloClient' => $helloClient]);
    }
}