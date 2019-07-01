<?php
/**
 * Class ControleurMonCompte
 * Controleur pour la gestion des information de son compte
 */

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

    /**
     * Pour changer les informations de son compte
     */
    public function updateMonCompte(){

        $data=$_POST;

        $message=null;

        if(!empty($data)){


            if(!$this->verifPost($data))
            {

                $membreUpdate = $this->ObjetMembre($data);

                if($_FILES['avatar']['name'] != null){
                    $retour = $this->uploadImgProfile('avatar','VIEW/images/avatar_'.$membreUpdate->getId().'.png',1048576,array('png','gif','jpg','jpeg','JPG'));

                    if(!$retour){
                        $message = $this->affMessage('Image invalide (taille trop grande ou format incorrect)','rouge');
                        return $this->afficheMonCompte($message);
                    }
                }



                if(!$this->verifEmail($membreUpdate->getCourriel())){

                    $message = $this->affMessage('Merci de bien remplir le champ courriel','rouge');
                    return $this->afficheMonCompte($message);
                }

                $managerMembre = new ManagerMembre();


                $_SESSION['email'] = $membreUpdate->getCourriel();

                $managerMembre->updateMembre($membreUpdate);

                $message = $this->affMessage('Compte modifié','vert');
            }else{

                $message = $this->affMessage(CHAMP_VIDE,'rouge');

            }
        }

        return $this->afficheMonCompte($message);

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



    /**
     * Methode pour charger l'image du compte
     *
     * @param $index
     * @param $destination
     * @param bool $maxsize
     * @param bool $extensions
     * @return bool
     */

public function uploadImgProfile($index,$destination,$maxsize = false,$extensions= false)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return false;
   //Test2: taille limite
     if ($maxsize !== false AND $_FILES[$index]['size'] > $maxsize) return false;
   //Test3: extension
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== false AND !in_array($ext,$extensions)) return false;
   //Déplacement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}



    /**
     * Pour afficher le message dans une div avec une couleur
     * fonctionne avec Bootstrap 4
     *
     * @param string $texte
     * @param string $couleur
     * @return string|null
     */
    private function affMessage(string $texte,string $couleur){

        $retour = null;

        if ($couleur === 'vert'){
            $retour = "<div class=\"alert alert-success\">$texte</div>";
        }elseif($couleur = 'rouge'){
            $retour = "<div class=\"alert alert-danger\">$texte</div>";
        }

        return $retour;

    }

}