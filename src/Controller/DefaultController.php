<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        // Nous générons du contenu pour notre réponse
        $hello = 'Bienvenue';

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('home.html.twig', ['hello' => $hello]);
    }
}