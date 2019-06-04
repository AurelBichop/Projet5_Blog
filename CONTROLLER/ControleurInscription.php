<?php


class ControleurInscription

{

    public function affichePageInscription($message = null)
    {


        /******************************
         * Création de la Vue en Objet
         ******************************/

        $vue = new Vue('inscription', 'Inscription');

        $vue->generer(array(
                            'details'=>'Voir détails &raquo;',
                            'message'=>$message
                            ));

    }


    public function addObjetMembre(array $data)
    {

        $nouveauMembre = new Membre($data);
        return $nouveauMembre;

    }

    public function enregistreMembre()
    {
        if(!$this->verifPost($_POST))
        {
            $data = $_POST;
        }else{
            $message = 'Merci de Bien renseigner tous les Champs';
            return $this->affichePageInscription($message);
        }


        var_dump($data);


        $newmembre = $this->addObjetMembre($data);

        $manager = new ManagerMembre();
        $manager->addBDD($newmembre);


        // Renvoie sur la page d'accueil
        $controlleurBillet = new ControleurConnexion();
        $message = 'Inscription Réussi, Bienvenue sur notre blog';
        return $controlleurBillet->affichePageConnexion($message);

    }


    private function verifPost(array $post){

        $retour = false;
var_dump($post);
        foreach ($post as $a){

                if(strlen(trim($a))<3){
                    $retour = true;


            }
        }
        return $retour;
    }



     /*
     *
     *
     * exemple
     * $tab = array(array('nom'=>'fga','prenom'=>'dfg'));

    function testtab(array $tab){
    $retour = false;

    foreach ($tab as $a){

    foreach($a as $b){


    if(strlen(trim($b))<3){
    $retour = true;
    }



    }
    }
    return $retour;
    }


    $verif = testtab($tab);
    var_dump($verif);

    if(!$verif){
    echo 'je recupere les données';
    }
    */
}