<?php

require_once 'Hydrate.php';
require_once 'tools/BilletException.php';

class Billet

{
    use Hydrate;

    private $_id;
    private $_id_membre;
    private $_chapeau;
    private $_contenu;
    private $_date;

    /**
     * Billet constructor.
     */

    public function __construct($donnees)
    {

        if ($donnees === false){

            throw new BilletException();
        }

        $this->hydrate($donnees);

    }

    public function setId($id)
    {
        $this->_id = $id;
    }


    public function setIdmembre($id_membre)
    {
        $this->_id_membre = $id_membre;
    }

    /**
     * @param mixed $contenu
     */
    public function setChapeau($chapeau)
    {
        $this->_chapeau = $chapeau;
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
    public function setDate($date)
    {
        $this->_date = $date;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    public function getIdmembre()
    {
        return $this->_id_membre;
    }

    /**
     * @return mixed
     */
    public function getChapeau()
    {
        return $this->_chapeau;
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
    public function getDate()
    {
        return $this->_date;
    }
}