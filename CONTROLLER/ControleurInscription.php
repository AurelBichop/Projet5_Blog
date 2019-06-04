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

        if (!$this->verifPass($data['password'],$data['verif'])){
            $message = 'Les mots de pass sont différents';
            return $this->affichePageInscription($message);
        }

        if(!$this->verifEmail($data['courriel'])){
            $message = 'Email invalide ou deja existant';
            return $this->affichePageInscription($message);
        }


        $newmembre = $this->addObjetMembre($data);

        $manager = new ManagerMembre();
        $manager->addBDD($newmembre);


        // Renvoie sur la page d'accueil
        $controlleurBillet = new ControleurConnexion();
        $message = 'Inscription Réussi, Bienvenue sur notre blog, Merci de vous connecter';
        return $controlleurBillet->affichePageConnexion($message);

    }


    /**
     * @param array $post
     * @return bool
     */
    private function verifPost(array $post){

        $retourPost = false;
        foreach ($post as $a){

                if(strlen(trim($a))<3 OR strlen(trim($a))>30){
                    $retourPost = true;
            }
        }
        return $retourPost;
    }

    /**
     * @param $pass
     * @param $verif
     * @return bool
     */

    private function verifPass($pass, $verif){

        if($pass === $verif){
            return true;
        }

        return false;
    }

    /**
     * @param $mail
     * @return bool
     */

    private function verifEmail($mail){

        $retour = false;

         if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)){

             $ObjManagerMembre = new ManagerMembre();

             if($ObjManagerMembre->verifMail($mail)){
                 $retour = true;
             }
         }

         return $retour;
    }

}