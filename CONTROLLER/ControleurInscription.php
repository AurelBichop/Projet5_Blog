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

    /**
     * @param array $data
     * @return Membre
     */
    public function addObjetMembre(array $data)
    {
        $nouveauMembre = new Membre($data);
        return $nouveauMembre;
    }


    /**
     * Permet l'enregistrement ede nouveau Membre en BDD suite aux verifications des informations
     * Renvoie sur la page connexion
     */

    public function enregistreMembre()
    {
        if(!$this->verifPost($_POST))
        {
            $data = $_POST;
        }else{
            var_dump($_POST);
            $message = CHAMP_VIDE;
            return $this->affichePageInscription($message);
        }

        if (!$this->verifPass($data['password'],$data['verif'])){
            $message = 'Les mots de passe sont différents';
            return $this->affichePageInscription($message);
        }

        if(!$this->verifEmail($data['courriel'])){
            $message = 'Email invalide ou déja existant';
            return $this->affichePageInscription($message);
        }

        if (!$this->verifCaptcha()){
            $message = 'Merci de cocher le captcha';
            return $this->affichePageInscription($message);
        }


        $newmembre = $this->addObjetMembre($data);

        $manager = new ManagerMembre();
        $manager->addBDD($newmembre);


        // Renvoie sur la page d'accueil
        $controlleurBillet = new ControleurConnexion();
        $message = 'Inscription réussi, bienvenue sur notre blog, merci de vous connecter';
        return $controlleurBillet->affichePageConnexion($message);

    }


    /**
     * Verifie que les Champs soient rempli
     * avec Minimum 3 caracteres et maximum 30
     *
     * @param array $post
     * @return bool
     */
    private function verifPost(array $post){

        $retourPost = false;

        foreach ($post as $a){

                if(strlen(trim($a))<3 OR strlen(trim($a))>500){
                    $retourPost = true;
            }
        }
        return $retourPost;
    }

    /**
     * Verifie que les mots de passes soient identique
     *
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
     * Verifie que le courriel correspond au format email et n'existe pas deja en BDD
     *
     * @param $mail
     * @return bool
     */

    private function verifEmail($mail){

        $retour = false;

        $mail = strtolower($mail);

         if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)){

             $ObjManagerMembre = new ManagerMembre();

             if($ObjManagerMembre->verifMail($mail)){
                 $retour = true;
             }
         }

         return $retour;
    }

    /**
     * Verification du captcha
     * @return bool
     */
    private function verifCaptcha(){

        $retour = false;
        // Ma clé privée
        $secret = CLEF_SERVEUR;
        // Paramètre renvoyé par le recaptcha
        $response = $_POST['g-recaptcha-response'];


        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $secret
            . "&response=" . $response;


        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == true) {
            $retour = true;
        }

        return $retour;
    }

}