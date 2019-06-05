<?php

/**
 * Class Utils avec des fonctions static pour des besoins qui n'entre pas dans le MVC
 */


class Utils{


    /**
     * Methode pour limiter le nombre de caracter a l'affichage
     * @param string $contenu
     * @return bool|string
     */

     public static function Lireplus(string $contenu){

        $contenu = substr($contenu, 0,150);
        return $contenu.'...';
    }


}