<?php


class ControleurMonCompte
{

    public function afficheMonCompte($erreur=null){

        if(!isset($_SESSION['connecte'])){
            $pageConnexion = new ControleurConnexion();
            return $pageConnexion->affichePageConnexion();
        }

        $message=$erreur;

        $managerMembre = new ManagerMembre();

        $membre = $managerMembre->getOneMembre($_SESSION['email']);

        $vue = new Vue('compte', 'Mon Compte');

        $vue->generer(array('membre'=>$membre,'message'=>$message));
    }


    public function updateMonCompte(){

        $data=$_POST;

        $message=null;

        if(!empty($data)){

            if(!$this->verifPost($data))
            {
                $membreUpdate = $this->ObjetMembre($data);

                if(!$this->verifEmail($membreUpdate->getCourriel())){

                    $message = 'Merci de bien remplir le champ Courriel';
                    return $this->afficheMonCompte($message);
                }

                $managerMembre = new ManagerMembre();


                $_SESSION['email'] = $membreUpdate->getCourriel();

                $managerMembre->updateMembre($membreUpdate);

                $message = 'Compte Modifié';
            }else{
                $message = CHAMP_VIDE;
            }
        }


        $this->afficheMonCompte($message);


    }


    /**
     * Permet de creer un Objet Membre

     * @param array $data
     * @return Membre
     */

    public function ObjetMembre(array $data){
        $membre = new Membre($data);
        return $membre;
    }

    /**
     * Verifie que les Champs soient rempli
     * avec Minimum de 3 caracteres
     *
     * @param array $post
     * @return bool
     */
    private function verifPost(array $posts){

        $retourPost = false;

        foreach ($posts as $key=>$post){
            if($key !== 'id'){
                if((strlen(trim($post))<3)){
                    $retourPost = true;
                }
            }
        }

        return $retourPost;
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

           $retour = true;
        }

        return $retour;
    }
}