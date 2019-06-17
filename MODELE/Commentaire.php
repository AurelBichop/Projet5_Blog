<?php

/**
 * Class Commentaire
 * Permet de représenter l'entité Commentaire
 */
class Commentaire

{
    use Hydrate; // trait pour l'hydratation de l'objet

    private $_id;
    private $_id_billet;
    private $_id_membre;

    private $_nom;
    private $_prenom;

    private $_contenu;
    private $_date_heure;

    /**
     * Billet constructor.
     */

    public function __construct($donnees)
    {
        $this->hydrate($donnees);
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param $id_billet
     */
    public function setIdBillet($id_billet)
    {
        $this->_id_billet = $id_billet;
    }

    /**
     * @param $id_membre
     */
    public function setIdMembre($id_membre)
    {
        $this->_id_membre = $id_membre;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }


    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
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

    /**
     * @return mixed
     */
    public function getIdbillet()
    {
        return $this->_id_billet;
    }

    /**
     * @return mixed
     */
    public function getIdMembre()
    {
        return $this->_id_membre;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return ucfirst($this->_nom);
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return ucfirst($this->_prenom);
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->_contenu;
    }

    /**
     * Renvoie la date formaté
     *
     * @return string
     * @throws Exception
     */
    public function getDate()
    {
        $date = new DateTime($this->_date_heure);

        return $date->format('d-m-Y à H:i');
    }




}