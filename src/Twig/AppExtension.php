<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('castToArray', [$this, 'castToArray']),
        ];
    }

    public function castToArray( $stdClassObject): array
    {
        //On transforme l'objet en tableau
             return (array) $stdClassObject;
    }

}