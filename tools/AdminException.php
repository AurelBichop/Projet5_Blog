<?php
/**
 * Class For Exception
 *
 */

class AdminException extends Exception
{

    /**
     * @return mixed
     */

    public function getLoginAdminError()
    {
        $vue = new Vue('erreur', 'Erreur');

        $error = 'Acces Interdit' ;
        $path = '?action=accueil';
        $vue->generer(array(
            'message' => $error,
            'path'=>$path
        ));
    }

}
