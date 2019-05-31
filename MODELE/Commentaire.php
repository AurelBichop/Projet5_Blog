<?php

require_once 'Hydrate.php';

class Commentaire

{
    use Hydrate;

    private $_id;
    private $_id_billet;
    private $_id_membre;
    private $_contenu;
    private $_date_heure;

    /**
     * Billet constructor.
     */

    public function __construct($donnees)
    {
        $this->hydrate($donnees);
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setIdbillet($id_billet)
    {
        $this->_id_billet = $id_billet;
    }

    public function setIdmembre($id_membre)
    {
        $this->_id_membre = $id_membre;
    }

      /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->_contenu = $contenu;
    }

    /**
     * @param mixed $date
     */
    public function setDateheure($date)
    {
        $this->_date_heure = $date;
    }


    /**
     * @return mixed
     */

    public function getId()
    {
        return $this->_id;
    }


    public function getIdbillet()
    {
        return $this->_id_billet;
    }


    public function getIdmembre()
    {
        return $this->_id_membre;
    }


    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->_contenu;
    }

    /**
     * @return mixed
     */
    public function getDateheure()
    {
        return $this->_date_heure;
    }




}