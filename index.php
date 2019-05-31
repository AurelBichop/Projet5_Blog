<?php
session_start();

/**
 * Autoloader
 * @param $class_name
 */

function load($class_name){

    if(strstr($class_name,'Controleur')){
        require_once 'CONTROLLER/'.$class_name.'.php';

    }elseif (strstr($class_name,'Vue')){
        require_once 'VIEW/'.$class_name.'.php';
    }
    else{
        require_once 'MODELE/'.$class_name.'.php';
    }
}

spl_autoload_register('load');

/***********************************************/


/************************************
 *
 *  Routeur action
 *
 * ********************************/

//check the existence of $_GET['action']
$actionGet = null;

if (isset($_GET['action'])){
    $actionGet = $_GET['action'];
}


try {

    if ($actionGet) {

        switch ($actionGet) {

            
            case 'accueil':

                $controlleurBillet = new ControleurBillet();
                $controlleurBillet->afficheListeBillet();
                break;


            case 'listebillet':
                $controlleurListBillet = new ControleurBillet();
                $controlleurListBillet->afficheBilletPagination();
                break;


            case 'billet':
                $controlleurBillet = new ControleurBillet();
                $controlleurBillet->choixBillet();
                break;


            case 'inscription':

                $controlleurInscription = new ControleurInscription();
                $controlleurInscription->affichePageInscription();
                break;

            case 'connexion':

                $controlleurConnexion = new ControleurConnexion();
                $controlleurConnexion->affichePageConnexion();
                break;

            case 'newconnection':
                $controlleurConnexion = new ControleurConnexion();
                $controlleurConnexion->testConnexion();
                break;

            case 'contact':

                $controlleurContact = new ControleurContact();
                $controlleurContact->affichePageContact();
                break;


            case 'newinscription':

                $controlleurInscription = new ControleurInscription();
                $controlleurInscription->enregistreMembre();
                break;

            case 'newcommentaire':

                $controlleurCommentaire = new ControleurBillet();
                $controlleurCommentaire->addCommentaire();
                break;


            case 'deconnexion':

                $controlleurDeconnexion = new ControleurConnexion();
                $controlleurDeconnexion->deconnexion();
                break;

            default:
                $controlleurBillet = new ControleurBillet();
                $controlleurBillet->afficheListeBillet();

        }

    } else {
        $controlleurBillet = new ControleurBillet();
        $controlleurBillet->afficheListeBillet();
    }


}catch (BilletException $e){
    $e->getPageError();

}catch (LoginException $e){
    $e->getLoginError();

}catch (Exception $e){
    $e->getMessage();
}


var_dump($_SESSION);


