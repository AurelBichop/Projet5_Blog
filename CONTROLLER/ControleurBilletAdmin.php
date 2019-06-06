<?php


class ControleurBilletAdmin extends ControleurBillet
{

    public function __construct()
    {

        if (!$this->logged()){
            throw new AdminException();
        }

    }

    /**
     * Verifie que l'administrateur est bien connecté
     * @return bool
     */
    public function logged(){

        if(isset($_SESSION['administrateur'])){
            if($_SESSION['administrateur'] == 1){
                return true;
            }
        }

        return false;
    }

    /********************************************************
     * Création de la Vue en Objet Pour l'ajout d'article
     ********************************************************/
    public function afficheAdminAdd($message = null){

        $vue = new Vue('admin/AddBilletAdmin', 'Admin Articles');

        $vue->generer(array('message'=>$message));
    }

    /**
     * Fonction pour l'ajout d'un article
     * @throws BilletException
     */
    public function BilletAdd(){

        $message = null;

        if(!empty($_POST)){

            if(!$this->verifPost($_POST))
            {
                $data = $_POST;
            }else{
                $message = CHAMP_VIDE;
                return $this->afficheAdminAdd($message);
            }

            $billet = $this->ObjetBillet($data);

            $managerBillet = new ManagerBillet();
            $managerBillet->addBilletBDD($billet);

            $message =  'Article Ajouté';
        }

        $this->afficheAdminAdd($message);
    }

    /**
     * Permet de creer un Objet Billet
     *
     * @param array $data
     * @return Billet
     * @throws BilletException
     */

    public function ObjetBillet(array $data){
        $newBillet = new Billet($data);
        return $newBillet;
    }

    /**
     * Pour l'update d'un article
     */

    public function BilletEdit(){

        $data = $_POST;

        $message = null;

        $managerBillet = new ManagerBillet();

        if(!empty($data)){

            if(!$this->verifPost($data))
            {
                $billetUpdate = $this->ObjetBillet($data);
                $managerBillet->updateBilletBDD($billetUpdate);
                $message = 'Article Modifié';
            }else{
                $message = CHAMP_VIDE;
            }
        }

        $idBillet = $this->VerifIdBillet();

        $billetSelect = $managerBillet->getBilletSelect($idBillet);

        $vue = new Vue('admin/EditBilletAdmin', 'Edit Articles');

        $vue->generer(array('message'=>$message,'billet'=>$billetSelect));
    }


    private function VerifIdBillet(){

        if ($_GET['action'] === 'admin.billet.edit'){
            if(!empty($_GET['id']))
            {
                return $idBillet =  $_GET['id'];
            }
        }

        return null;
    }


    /**
     * Verifie que les Champs soient rempli
     * avec Minimum de 5 caracteres
     *
     * @param array $post
     * @return bool
     */
    private function verifPost(array $post){

        $retourPost = false;

        if((strlen(trim($post['chapeau']))<5 || strlen(trim($post['contenu']))<5)){
            $retourPost = true;
        }
        return $retourPost;
    }

}