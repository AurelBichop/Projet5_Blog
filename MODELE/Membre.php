<?php


 class Membre
 {
     use Hydrate;

     private $_id;
     private $_is_administrateur;
     private $_nom;
     private $_prenom;
     private $_courriel;
     private $_password;
     private $_date_inscription;


     public function __construct(array $donnees)
     {
         $this->hydrate($donnees);
     }

     /**
      * @param mixed $id
      */
     public function setId($id)
     {
         $this->_id = $id;
     }

     /**
      * @return mixed
      */
     public function setIsadministrateur($is_administrateur)
     {
         $this->_is_administrateur = $is_administrateur;
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
      * @param mixed $courriel
      */
     public function setCourriel($courriel)
     {
         $this->_courriel = strtolower($courriel);
     }

     /**
      * @param mixed $password
      */
     public function setPassword($password)
     {
         $this->_password = $password;
     }


     /**
      * @param mixed $date_inscription
      */
     public function setDateinscription($date_inscription)
     {
         //date time test le type
         $this->_date_inscription = $date_inscription;
     }


     /**
      * @return mixed
      */
     public function getId()
     {
         return $this->_id;
     }

     public function getIsadministrateur()
     {
        return $this->_is_administrateur;
     }

     /**
      * @return mixed
      */
     public function getNom()
     {
         return $this->_nom;
     }


     /**
      * @return mixed
      */
     public function getPrenom()
     {
         return $this->_prenom;
     }

     /**
      * @return mixed
      */
     public function getCourriel()
     {
         return $this->_courriel;
     }

     /**
      * @return mixed
      */
     public function getPassword()
     {
         return $this->_password;
     }

     /**
      * @return mixed
      */
     public function getDateinscription()
     {
         return $this->_date_inscription;
     }

 }