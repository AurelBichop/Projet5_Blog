<?php
session_start();

require_once 'config/config.php';
require_once 'debug/Debug.php';
require_once 'tools/Utils.php';

//A faire avec l'autoloader
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

//liste des actions lié au controlleur et a la methode associé
$listAction = [
    'accueil'=>['Billet','afficheListeBillet'],
    'listebillets'=>['Billet','afficheBilletPagination'],
    'billet'=>['Billet','choixBillet'],
    'newcommentaire'=>['Billet','addCommentaire'],

    'inscription'=>['Inscription','affichePageInscription'],
    'newinscription'=>['Inscription','enregistreMembre'],

    'connexion'=>['Connexion','affichePageConnexion'],
    'newconnection'=>['Connexion','testConnexion'],
    'deconnexion'=>['Connexion','deconnexion'],

    'contact'=>['Contact','affichePageContact'],
    'contact.postEmail'=>['Contact','postEmail'],

    'moncompte'=>['MonCompte','afficheMonCompte'],
    'moncompte.update'=>['MonCompte','updateMonCompte'],

    'admin.billet'=>['BilletAdmin','afficheBilletPagination'],
    'admin.billet.add'=>['BilletAdmin','BilletAdd'],
    'admin.billet.edit'=>['BilletAdmin','BilletEdit'],
    'admin.billet.delete'=>['BilletAdmin','BilletDelete'],
    'admin.billet.commentaire'=>['BilletAdmin','listCommentaires'],
    'admin.commentaire.update'=>['BilletAdmin','ValidCommentaire'],
    'admin.commentaire.delete'=>['BilletAdmin','CommentaireDelete']

];


$actionGet = 'accueil';

//Verifie l'existance de $_GET['action']

if (!empty($_GET['action'])){
    $actionGet = $_GET['action'];
}

try{

    if (isset($listAction[$actionGet])){

        //construction du controleur
        $nomControleur = "Controleur".$listAction[$actionGet][0];
        $controleur = new $nomControleur();

        //construction de la methode
        $methode = $listAction[$actionGet][1];


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



