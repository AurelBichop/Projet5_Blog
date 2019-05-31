<?php

require_once 'config/config.php';


abstract class AbstractManager

{
    /**
     * @var objet PDO d'acces a la BDD
     */

    private $_bdd;

    // Exécute une requête SQL éventuellement paramétrée
    protected function executerRequete($sql, $params = null) {

        if ($params == null) {

          $resultat = $this->getBDD()->query($sql);    // exécution directe

        }
        else {
            $resultat = $this->getBDD()->prepare($sql);  // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }

    /**
     * @return PDO dans l'attribut privé $_bdd pour se connecter et l'initialise si besoin
     */

    private function getBDD()
    {
        if ($this->_bdd == null)
        {
            $this->_bdd = new PDO(DSN, USER, PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->_bdd;

    }




}