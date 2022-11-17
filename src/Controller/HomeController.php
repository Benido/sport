<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'app_home')]
    public function index()
    {


        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('home.html.twig', ['hello' => $hello]);
    }
}