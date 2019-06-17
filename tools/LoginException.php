<?php
/**
 * Class LoginException
 * Pour la gestion d'une exception à la connexion d'un membre
 */

class LoginException extends Exception
{
    public function getLoginError()
    {
        $vue = new Vue('erreur', 'Erreur');

        $error = 'Mauvais identifiant ou mot de passe' ;
        $path = '?action=connexion';
        $vue->generer(array(
            'message' => $error,
            'path'=>$path
        ));
    }
}