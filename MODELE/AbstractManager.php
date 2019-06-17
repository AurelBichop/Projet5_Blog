<?php

/**
 * Class AbstractManager
 * Gere la connection a la base de données ainsi que l'envoie des requetes
 */

abstract class AbstractManager

{
    /**
     * @var objet PDO d'acces a la BDD
     */

    private $_bdd;



    /**
     * Exécute une requête SQL éventuellement paramétrée
     * @param $sql
     * @param null $params
     * @return bool|false|PDOStatement
     */
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
     * Retourne $_bdd pour se connecter et l'initialise si besoin
     *
     * @return objet|PDO
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