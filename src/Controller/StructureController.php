<?php

namespace App\Controller;

use App\Repository\StructureRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StructureController extends AbstractController
{
    //Affiche la page Structure

    #[Route(path: '/structure/{id}', name: 'app_structure', methods : ['GET'])]
    public function structure(string $id, StructureRepository $structureRepo) {
        if (!$this->isGranted('ROLE_ADMIN')){
            //On vérifie que l'utilisateur a bien le ROLE_CLIENT et qu'il supervise cette structure
            if ($this->isGranted('ROLE_CLIENT')) {
                $clientStructures = $this->getUser()->getPartenaire()->getStructures();
                $structureIds = [];
                foreach ($clientStructures as $structure) {($structureIds[] = (string) $structure->getId());}
                if (!in_array($id, $structureIds) ) {
                    return $this->redirectToRoute('app_home', array('error' => 'vos structures sont :' . implode(', ', $structureIds)));
                }
                //On vérifie que l'utilisateur a bien le ROLE_MANAGER et qu'il gère cette structure
            }  elseif ($this->isGranted('ROLE_MANAGER')) {
                $idStructure = (string)$this->getUser()->getStructure()->getId();
                if ($id !== $idStructure) {
                    return $this->redirectToRoute('app_home', array('error' => 'votre structure_id est :' . $idStructure));
                }
            }
        }
        // On va chercher l'entité Structure correspondant à l'id passé en paramètre URL
        $structure = $structureRepo->find($id);
        $permissions = (array) json_decode($structure->getPermissions());

        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return $this->render('structure.html.twig', [
            'structure' => $structure,
            'permissions' => $permissions
            ]);
    }

    //Edite les permissions de la structure

    #[Route(path: '/structure/{id}/permissions', name:'app_structure_permissions', methods: ['POST'])]
    public function editStructure (string $id, Request $request, StructureRepository $structureRepository): Response
    {
        //On vérifie que l'utilisateur a bien le ROLE_CLIENT et que l'id du partenaire correspond
       /* if (!$this->isGranted('ROLE_ADMIN')) {
            $idPartenaire = (string) $this->getUser()->getPartenaire()->getId();
            if ($id !== $idPartenaire ) {
                return $this->redirectToRoute('app_home', array('error' => 'votre partenaire_id est :' . $idPartenaire));
            }
        }
       */
        $permissions = $request->toArray();
        $structure = $structureRepository->find($id);
        $structure->setPermissions( json_encode($permissions));
        $structureRepository->save($structure, true);

        return new Response('Permissions modifiées pour ' . $structure->getAddress() . ', ' . $structure->getCity());
    }

    //Edite le statut d'activité de la structure

    #[Route(path: '/structure/{id}/isactive', name:'app_structure_isactive', methods: ['POST'])]
    public function editPartenaireActiveState (string $id, Request $request, StructureRepository $structureRepository): Response
    {
        //Nous persistons la modification du statut de la structure.
        $isActive = $request->request->getBoolean('isActive');
        $structure = $structureRepository->find($id);
        $structure->setActive($isActive);
        $structureRepository->save($structure, true);


        // Nous retournons un objet Response auquel nous avons fourni le contenu
        return new Response('Changement statut effectué');
    }
}