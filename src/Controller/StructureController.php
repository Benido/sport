<?php

namespace App\Controller;

use App\Repository\StructureRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StructureController extends AbstractController
{
    #[Route(path: '/structure/{id}', name: 'app_structure')]
    public function structure(string $id, StructureRepository $structureRepo) {
        //On vérifie que l'utiliseur a bien le ROLE_MANAGER et que l'id du partenaire correspond
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_CLIENT')) {
            $idStructure = (string) $this->getUser()->getStructure()->getId();
            if ($id !== $idStructure ) {
                return $this->redirectToRoute('app_home', array('error' => 'votre structure_id est :' . $idStructure));
            };
        }
        // Nous générons du contenu pour notre réponse
        $structure = $structureRepo->find($id);


        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('structure.html.twig', [
            'structure' => $structure]);
    }
}