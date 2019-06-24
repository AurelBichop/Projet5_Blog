<?php

/**
 * Class ControleurConnexion
 * Pour la connexion des membres inscrits
 */

class ControleurConnexion

{

    /**
     * Affiche la page connexion
     *
     * @param null $message
     * @throws Exception
     */

    public function affichePageConnexion($message = null)
    {

        /******************************
         * Création de la Vue en Objet
         ******************************/

        $vue = new Vue('connexion', 'Connexion');

        $vue->generer(array('details'=>'Voir détails &raquo;','message'=>$message));

    }

    /**
     * Verifie que les informations de connection existent
     *
     * @throws BilletException
     * @throws LoginException
     */
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
     * Permet la connection au blog
     *
     * @param $dataLogin
     * @param $dataPass
     * @throws BilletException
     * @throws LoginException
     */

    public function connexion($dataLogin, $dataPass){

        $managerMembre = new ManagerMembre();

        //vérifie si le membre existe
        if ($oneMembre = $managerMembre->getOneMembre($dataLogin)){

            //vérifie le mot de passe du membre
            if ($this->verifOneMembre($oneMembre, $dataPass)){

                $_SESSION['connecte'] = 1;
                $_SESSION['id'] = $oneMembre->getId();
                $_SESSION['administrateur'] = $oneMembre->getIsadministrateur();
                $_SESSION['nom'] = $oneMembre->getNom();
                $_SESSION['prenom'] = $oneMembre->getPrenom();
                $_SESSION['email'] = $oneMembre->getCourriel();

                // Renvoie sur la page d'accueil
                $controlleurBillet = new ControleurBillet();
                $message = 'Connexion réussi';
                $controlleurBillet->afficheListeBillet($message);

            }else{
                throw new LoginException();
            }
        }
    }


    /**
     * Pour la deconnexion du membre
     *
     * @throws BilletException
     */
    public function deconnexion()
    {
        session_destroy();
        $_SESSION = [];
        
        // Renvoie sur la page d'accueil
        $controlleurBillet = new ControleurBillet();
        $message = 'Déconnexion réussie';
        $controlleurBillet->afficheListeBillet($message);
    }

    /**
     * Vérifie le mot de passe du membre
     *
     * @param $member
     * @param $password
     * @return bool
     */
    public function verifOneMembre($member, $password){

        $connexion = false;
            if (password_verify($password, $member->getPassword()))
            {
                $connexion = true;
            }
        return $connexion;
    }


}