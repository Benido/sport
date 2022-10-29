<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BranchController extends AbstractController
{
    #[Route(path: '/branch', name: 'app_manager')]
    public function branch() {
        // Nous générons du contenu pour notre réponse
        $helloManager = 'Ici c\'est la vue manager';

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('branch.html.twig', ['helloManager' => $helloManager]);
    }
}