<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PartenaireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class PanelController extends AbstractController
{

    #[Route(path: '/panel', name: 'app_panel')]
    public function panel(PartenaireRepository $partenaireRepo, Request $request): Response
    {
        // Nous générons du contenu pour notre réponse
        $partenaires = $partenaireRepo->findAll();

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        $response = $this->render('panel.html.twig', ['partenaires' => $partenaires]);
        $response->setEtag(md5($response->getContent()));
        $response->setPublic();
        $response->isNotModified($request);

        return $response;
    }
}