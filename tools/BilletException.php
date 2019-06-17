<?php
/**
 * Class pour les exceptions de billet inexistant
 *
 */

class BilletException extends Exception
{

    /**
     * @return mixed
     */

    public function getPageError()
    {
        $vue = new Vue('erreur', 'Erreur');

        $error = 'ERREUR Ce billet n\'existe pas' ;
        $vue->generer(array(
            'message' => $error
        ));
    }

}