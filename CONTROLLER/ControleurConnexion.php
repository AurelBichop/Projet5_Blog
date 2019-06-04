<?php

class ControleurConnexion

{

    public function affichePageConnexion($message = null)
    {

        /******************************
         * Création de la Vue en Objet
         ******************************/

        $vue = new Vue('connexion', 'Connexion');

        $vue->generer(array('details'=>'Voir détails &raquo;','message'=>$message));

    }

    public function testConnexion(){

        if (!empty($_POST['login']) && (!empty($_POST['password']))) {
            $this->connexion($_POST['login'], $_POST['password']);

        }elseif(!empty($_POST['login'])||(!empty($_POST['password']))){

            throw new LoginException();
        }else
        {
            throw new LoginException();
        }
    }



     /**
     * Permet la connection apres vérification
     *
     * @param $dataNom
     * @param $dataPass
     *
     */

    public function connexion($dataLogin, $dataPass){

        $managerMembre = new ManagerMembre();

        //vérifie si le membre existe
        if ($OneMembre = $managerMembre->getOneMembre($dataLogin)){

            //vérifie le mot de passe du membre
            if ($this->verifOneMembre($OneMembre, $dataPass)){

                $_SESSION['connecte'] = 1;
                $_SESSION['id'] = $OneMembre->getId();
                $_SESSION['administrateur'] = $OneMembre->getIsadministrateur();
                $_SESSION['nom'] = $OneMembre->getNom();
                $_SESSION['prenom'] = $OneMembre->getPrenom();
                $_SESSION['email'] = $OneMembre->getCourriel();

                // Renvoie sur la page d'accueil
                $controlleurBillet = new ControleurBillet();
                $message = 'Connexion Reussi';
                $controlleurBillet->afficheListeBillet($message);

            }else{
                throw new LoginException();
            }
        }
    }

    public function deconnexion()
    {
        session_destroy();
        $_SESSION = [];
        
        // Renvoie sur la page d'accueil
        $controlleurBillet = new ControleurBillet();
        $message = 'Deconnexion Reussi';
        $controlleurBillet->afficheListeBillet($message);
    }

    public function verifOneMembre($member, $password){

        $connexion = false;
            if (password_verify($password, $member->getPassword()))
            {
                $connexion = true;
            }
        return $connexion;
    }


}