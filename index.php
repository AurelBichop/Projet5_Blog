<?php
session_start();

require_once 'config/config.php';
require_once 'debug/Debug.php';

require_once 'tools/Utils.php';
require_once 'tools/BilletException.php';
require_once 'tools/LoginException.php';
require_once 'tools/AdminException.php';
require_once 'tools/Autoloader.php';




/**
 * Chargement de l'autoloader
 */
$autoload = new Autoloader();
$autoload->register();


/************************************
 *
 *  Routeur action
 *
 * ********************************/

//Ensemble des Controlleurs et leurs methodes
$listControleur = [
    'ControleurBillet'=>[
        'accueil'=>'afficheListeBillet',
        'listebillets'=>'afficheBilletPagination',
        'billet'=>'choixBillet',
        'newcommentaire'=>'addCommentaire'
    ],

    'ControleurInscription'=>[
        'inscription'=>'affichePageInscription',
        'newinscription'=>'enregistreMembre'

    ],'ControleurConnexion'=>[
        'connexion'=>'affichePageConnexion',
        'newconnection'=>'testConnexion',
        'deconnexion'=>'deconnexion'
    ],

    'ControleurContact'=>[
    'contact'=>'affichePageContact'
    ],

    'ControleurMonCompte'=>[
        'moncompte'=>'afficheMonCompte',
        'moncompte.update'=>'updateMonCompte'
    ],
    'ControleurBilletAdmin'=>[
        'admin.billet'=>'afficheBilletPagination',
        'admin.billet.add'=>'BilletAdd',
        'admin.billet.edit'=>'BilletEdit',
        'admin.billet.delete'=>'BilletDelete',
        'admin.billet.commentaire'=>'listCommentaires',
        'admin.commentaire.update'=>'ValidCommentaire',
        'admin.commentaire.delete'=>'CommentaireDelete'
    ]

];


//liste des actions lié au controlleur
$listAction = [
    'accueil'=>'Billet',
    'listebillets'=>'Billet',
    'billet'=>'Billet',
    'newcommentaire'=>'Billet',

    'inscription'=>'Inscription',
    'newinscription'=>'Inscription',

    'connexion'=>'Connexion',
    'newconnection'=>'Connexion',
    'deconnexion'=>'Connexion',

    'contact'=>'Contact',

    'moncompte'=>'MonCompte',
    'moncompte.update'=>'MonCompte',

    'admin.billet'=>'BilletAdmin',
    'admin.billet.add'=>'BilletAdmin',
    'admin.billet.edit'=>'BilletAdmin',
    'admin.billet.delete'=>'BilletAdmin',
    'admin.billet.commentaire'=>'BilletAdmin',
    'admin.commentaire.update'=>'BilletAdmin',
    'admin.commentaire.delete'=>'BilletAdmin'

];


$actionGet = 'accueil';

//Verifie l'existance de $_GET['action']

if (!empty($_GET['action'])){
    $actionGet = $_GET['action'];
}

try{

    if (isset($listAction[$actionGet])){

        //construction du controleur
        $nomControleur = "Controleur".$listAction[$actionGet];
        $controleur = new $nomControleur();

        //construction de la methode
        $methode = $listControleur[$nomControleur][$actionGet];

        //appel la methode
        $controleur->$methode();

    }



}catch (BilletException $e){
    $e->getPageError();

}catch (LoginException $e){
    $e->getLoginError();

}catch (AdminException $e){
    $e->getLoginAdminError();

}catch (Exception $e){
    $e->getMessage();
}





/////////////////////////////////////////////////////////

  /*
   * Ancien Routeur
   ******************************************/


/*
try {

    if ($actionGet) {

        switch ($actionGet) {

            
            case 'accueil':

                $controlleurBillet = new ControleurBillet();
                $controlleurBillet->afficheListeBillet();
                break;


            case 'listebillets':
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


            case 'moncompte':
                $controlleurMembre = new ControleurMonCompte();
                $controlleurMembre->afficheMonCompte();
                break;

            case 'moncompte.update':
                $controlleurMembre = new ControleurMonCompte();
                $controlleurMembre->updateMonCompte();
                break;


            case 'admin.billet':

                $controlleurBilletAdmin = new ControleurBilletAdmin();
                $controlleurBilletAdmin->afficheBilletPagination();
                break;

            case 'admin.billet.add':
                $controlleurBilletAdmin = new ControleurBilletAdmin();
                $controlleurBilletAdmin->BilletAdd();
                break;

            case 'admin.billet.edit':
                $controlleurBilletAdmin = new ControleurBilletAdmin();
                $controlleurBilletAdmin->BilletEdit();
                break;

            case 'admin.billet.delete':
                $controlleurBilletAdmin = new ControleurBilletAdmin();
                $controlleurBilletAdmin->BilletDelete();
                break;

            case 'admin.billet.commentaire':
                $controlleurBilletAdmin = new ControleurBilletAdmin();
                $controlleurBilletAdmin->listCommentaires();
                break;

//
            case 'admin.commentaire.update':
                $controlleurBilletAdmin = new ControleurBilletAdmin();
                $controlleurBilletAdmin->ValidCommentaire();
                break;


            case 'admin.commentaire.delete':
                $controlleurBilletAdmin = new ControleurBilletAdmin();
                $controlleurBilletAdmin->CommentaireDelete();
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

}catch (AdminException $e){
    $e->getLoginAdminError();

}catch (Exception $e){
    $e->getMessage();
}
*/

//var_dump($_SESSION);


