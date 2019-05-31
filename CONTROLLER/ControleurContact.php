<?php


class ControleurContact

{

    public function affichePageContact()
    {


        /******************************
        * Création de la Vue en Objet
        ******************************/

        $vue = new Vue('contact', 'Contact');

        $vue->generer(array('details'=>'Voir détails &raquo;'));

    }

}
