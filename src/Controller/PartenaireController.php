<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\StructureRepository;

class PartenaireController extends AbstractController
{
    #[Route(path: '/partenaire', name:'app_partenaire')]
    public function client(StructureRepository $structureRepo) {
        // Nous générons du contenu pour notre réponse
        $id = $this->getUser()->getId();
        $structures = $structureRepo->findByClientId($id);

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('partenaire.html.twig', [
            'structures' => $structures,
            ]);
    }
}