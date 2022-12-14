<?php

namespace App\Controller;


use App\Entity\Structure;
use App\Repository\PartenaireRepository;
use App\Repository\StructureRepository;
use App\Service\JWTService;
use App\Service\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddStructureFormController extends AbstractController
{
    //Affiche la page Ajouter une nouvelle structure

    #[Route(path: '/ajouter_structure/{id}', name: 'ajouter_structure', methods : ['GET'])]
    public function addStructure (int $id, PartenaireRepository $partenaireRepo) : Response
    {
        $partenaire = $partenaireRepo->find($id);
        $client = $partenaire->getClient();
        $defaultPermissions = (array) json_decode($partenaire->getPermissions());

        return $this->render('addStructure.html.twig', [
            'partenaireId' => $id,
            'partenaire' => $partenaire,
            'client' => $client,
            'defaultPermissions' => $defaultPermissions
        ]);
    }


    //Envoie l'email demandant au Client la validation de l'ajout de la nouvelle structure

    #[Route(path: '/validation_structure', name: 'app_validation_structure', methods : ['POST'])]
    public function sendValidationEmail (Request $request, SendEmailService $mail, JWTService $jwt)
    {
            $newStructureJson = $request->toArray();

            //On extrait les données concernant la nouvelle structure
            $newStructure = $newStructureJson['structure'];
            //On récupère l'adresse mail du destinataire
            $email = $newStructureJson['email'];

            //On génère le Json Web Token qui permettra de sécuriser la validation
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];
            $payload = $newStructure;
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'), 604800);

            try {
                $emailVariables = [
                    'expiration_date' => (new \DateTime('+7 days'))->format('d-m-Y'),
                    'newStructure' => $newStructure,
                    'token' => $token
                ];

               $mail->send(
                    'besnie.remi@bbox.fr',
                    'remi.besnie@gmail.com',
                    'Création d\'une nouvelle structure',
                    'security/validationEmail.html.twig',
                    $emailVariables
               );

                return $this->render('security/validationEmail.html.twig', $emailVariables );

            } catch (\Exception $e) {
                    $this->addFlash('danger', 'L\'email n\'a pu être envoyé');
                    //return new Response($e->getMessage(),500,);
                    return $this->redirect($request->headers->get('referer'));
               }
    }

    //Vérifie le JWT comprenant les informations de la nouvelle structure et envoie un email de confirmation

    #[Route(path: '/verification_token/{token}', name: 'app_token_verification', methods : ['GET'])]
    public function tokenVerification($token, JWTService $jwt, StructureRepository $structureRepo, PartenaireRepository $partenaireRepo, SendEmailService $mail): Response
    {
        //On vérifie si le token est valide, n'a pas expiré et n'a pas été modifié
        if(
            $jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, $this->getParameter('app.jwtsecret'))){
            // On récupère le payload
            $payload = $jwt->getPayload($token);
            $partenaire = $partenaireRepo->find((int) $payload['partenaireId']);

            // On récupère la structure et on la sauvegarde en db
            $structure = (new Structure())
                ->setAddress($payload['address'])
                ->setPostalCode((int) $payload['postalCode'])
                ->setCity($payload['city'])
                ->setPermissions(json_encode($payload['permissions']))
                ->setActive('1')
                ->setPartenaire($partenaire);
            $structureRepo->save($structure, true);

            $this->addFlash('success', 'La nouvelle structure a bien été créée');

            /*      //On envoie l'email de confirmation
                   $email = $partenaire->getClient()->getEmail();

                    $mail->send(
                    'no-reply@sapik-permissions.com',
                    $email,
                    'La nouvelle structure a bien été créée',
                    'security/confirmationEmail.html.twig',
                    [
                        'newStructure' => $structure,
                    ]);
           */

            return $this->redirectToRoute('app_login');

        }
        // Si un problème se pose dans le token
        $this->addFlash('danger', 'Le token est invalide ou a expiré');
        return $this->redirectToRoute('app_login');
    }
}