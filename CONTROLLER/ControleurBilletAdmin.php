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


    public function afficheAdminAdd($message = null){
        /******************************
         * Création de la Vue en Objet
         ******************************/
        $vue = new Vue('admin/AddBilletAdmin', 'Admin Articles');

        $vue->generer(array('message'=>$message));
    }

    public function BilletAdd(){

        $message = null;

        if(!empty($_POST)){

            if(!$this->verifPost($_POST))
            {
                $data = $_POST;
            }else{
                $message = 'Merci de Bien renseigner tous les Champs';
                return $this->afficheAdminAdd($message);
            }

            $billet = $this->addObjetBillet($data);

            $managerBillet = new ManagerBillet();
            $managerBillet->addBilletBDD($billet);

            $message =  'Article Ajouté';
        }

        $this->afficheAdminAdd($message);
    }

    /**
     * Permet de creer un Objet Commentaire
     *
     * @param array $data
     * @return Billet
     * @throws BilletException
     */

    public function addObjetBillet(array $data){
        $newBillet = new Billet($data);
        return $newBillet;
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

        if((strlen($post['chapeau'])<5 || strlen($post['contenu'])<5)){
            $retourPost = true;
        }
        return $retourPost;
    }

}