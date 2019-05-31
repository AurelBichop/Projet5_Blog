<?php


class ControleurInscription

{

    public function affichePageInscription()
    {


        /******************************
         * Création de la Vue en Objet
         ******************************/

        $vue = new Vue('inscription', 'Inscription');

        $vue->generer(array('details'=>'Voir détails &raquo;'));

    }


    public function addObjetMembre(array $data)
    {

        $nouveauMembre = new Membre($data);
        return $nouveauMembre;

    }

    public function enregistreMembre()
    {
        $data = $_POST;

        $newmembre = $this->addObjetMembre($data);

        $manager = new ManagerMembre();
        $manager->addBDD($newmembre);

        // Renvoie sur la page d'accueil
        $controlleurBillet = new ControleurBillet();
        $controlleurBillet->afficheListeBillet();

    }

}