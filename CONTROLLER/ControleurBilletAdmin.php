<?php

/**
 * Class ControleurBilletAdmin
 * Controleur pour la gestion des billets et commentaires du blog
 */

class ControleurBilletAdmin extends ControleurBillet
{

    /**
     * ControleurBilletAdmin constructor.
     * Avec vérification de la connection de l'administrateur
     *
     * @throws AdminException
     */

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
     * Pour l'ajout d'un article
     *
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

            $message =  'Article ajouté';
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
     *
     * @throws BilletException
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
                $message = 'Article modifié';
            }else{
                $message = CHAMP_VIDE;
            }
        }

        $idBillet = $this->VerifIdBillet();

        $billetSelect = $managerBillet->getBilletSelect($idBillet);

        $vue = new Vue('admin/EditBilletAdmin', 'Edit Articles');

        $vue->generer(array('message'=>$message,'billet'=>$billetSelect));
    }

    /**
     * Pour la suppression d'un article
     */

    public function BilletDelete(){

        $numBillet = $_POST['id'];
        $managerBillet = new ManagerBillet();
        $managerBillet->deleteBilletBDD($numBillet);

        $message = 'Article supprimé';

        $this->afficheBilletPagination($message);

    }


    /**
     * Affiche les commentaire non validé pour un article choisi
     * @param null $message
     */

    public function listCommentaires($message = null){


        $idBillet = null;


        //verifie l'id du billet
        if (($_GET['action'] === 'admin.billet.commentaire') OR ($_GET['action'] === 'admin.commentaire.update') OR ($_GET['action'] === 'admin.commentaire.delete')){
            if(!empty($_GET['id'])){

                $idBillet =  $_GET['id'];
            }
        }

        $managerCommentaire = new ManagerCommentaire();
        $listCom = $managerCommentaire->getCommentaire($idBillet,1);


        if(!$listCom){
            $message = 'Aucun commentaires à administrer pour ce billet';
        }

        //vue de l'admin des commentaires

        $vue = new Vue('admin/listeCommentaireAdmin', 'Admin Commentaire');

        $vue->generer(array('message'=>$message,'listeCommentaires'=>$listCom));

    }


    /**
     * Permet la validation des commentaires
     */

    public function ValidCommentaire(){


        $idCom = null;

        //verifie l'id du commentaire
        if ($_GET['action'] === 'admin.commentaire.update'){
            if(!empty($_GET['id_commentaire'])){

                $idCom =  $_GET['id_commentaire'];
            }
        }


        $managerCom = new ManagerCommentaire();
        $managerCom->updateCom($idCom);


        $this->listCommentaires('Commentaire validé');
    }




    /**
     * Pour la suppression des commentaires
     */

    public function commentaireDelete(){

        $numCommentaire = $_POST['id_commentaire'];
        $managerBillet = new ManagerCommentaire();
        $managerBillet->deleteCommentaireBDD($numCommentaire);

        $message = 'Commentaire supprimé';

        $this->listCommentaires($message);
    }

    /**
     * Vérifie que le Billet existe dans l'interface administrateur
     *
     * @return mixed|null
     */
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
     * avec Minimum de 5 caractères
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