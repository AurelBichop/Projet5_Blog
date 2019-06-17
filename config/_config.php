<?php

/**
 * CONSTANTE POUR LA CONNECTION EN BDD
 */

define ('DSN', 'mysql:dbname=YOURBDD;host=YOURHOST');
define ('USER', 'UserBDD');
define ('PASSWORD', 'MDPBDD');


/**Contante Pour les messages d'erreur dans les champs vide **/

define('CHAMP_VIDE','Merci de Bien renseigner tous les Champs');


/**
 * Clef secrete pour les captchas Google
 */

define('CLEF_CLIENT','Votre clef client');
define('CLEF_SERVEUR','Votre clef serveur');