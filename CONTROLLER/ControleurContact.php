<?php
require_once 'config/config.php';
require_once 'tools/Utils.php';
require_once 'MODELE/ManagerBillet.php';
require_once 'MODELE/Billet.php';
require_once 'VIEW/Vue.php';
require_once 'debug/Debug.php';

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
