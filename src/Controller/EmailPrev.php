<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EmailPrev extends AbstractController
{
    public function previsualisationEmail() : Response
    {
        return $this->render('security/validationEmail.html.twig');
    }
}