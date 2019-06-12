<?php


class ControleurBillet
{

    public function afficheListeBillet($message = null)
    {

        /*********************************************************
         * Création de l'objet qui gere les données des billets
         ********************************************************/

        $managerBillets = new ManagerBillet();

        $listeBilletControlleur = $managerBillets->getBillets(1,6);

        $lastBilletControlleur = $managerBillets->getLastBillets();



        /******************************
         * Création de la Vue en Objet
         ******************************/

        $vue = new Vue('accueil', 'Accueil');

        $vue->generer(array(
            'lastBillet' =>$lastBilletControlleur,
            'listeBillet' => $listeBilletControlleur,
            'details'=>'Voir détails &raquo;',
            'message'=>$message
             ));

    }

    /**
     * Affichage de la liste de tous les billets paginé

     * @param $nombreBillets
     * @param string $page
     */

    public function afficheBilletPagination($nombreBillets, $page = 'listeBillets',$message = null){

        $nombreBillets = (int)$nombreBillets;

        $managerBillet = new ManagerBillet();


        $allBillets = $managerBillet->billetPagination($this->pageActuelle($nombreBillets),$nombreBillets);

        $nbDePage = ceil($managerBillet->nbBillets()/$nombreBillets);

        $vue = new Vue($page, 'Billets');

        $vue->generer(array(
            'listeBillets' => $allBillets,
            'pages'=>$nbDePage,
            'message'=>$message
        ));

    }

    /**
     * Affiche le billet selectionné
     * @param $id_billet
     * @throws BilletException
     */

    public function afficheBilletSelect($id_billet,$message = null)
    {
        $id_billet = (int)$id_billet;

        if (!(int)$id_billet){
            throw new BilletException();
        }

        $managerBillets = new ManagerBillet();
        $managerCommentaire = new ManagerCommentaire();

        $BilletSelect = $managerBillets->getBilletSelect($id_billet);


        //Affiche les commentaires avec validation
        $commentairesBilletSelect = $managerCommentaire->getCommentaire($BilletSelect->getID(),1);


        $numBilletSelect = 'Billet N '.$BilletSelect->getID(). ' ' . $BilletSelect->getChapeau();

        $vue = new Vue('billet', $numBilletSelect);

        $vue->generer(array(
            'Billet' =>$BilletSelect,
            'Commentaires'=>$commentairesBilletSelect,
            'message'=>$message,
        ));

    }

    /**
     * Permet de creer un objet commentaire
     * @param array $data
     * @return Commentaire
     */

    public function addObjetCommentaire(array $data){
        $newCommentaire = new Commentaire($data);
        return $newCommentaire;
    }

    /**
     * Enregistre le commentaire en BDD et renvoi sur le billet lié
     * @throws BilletException
     */

    public function addCommentaire(){

        $data = $_POST;
        $message = null;

        if(!empty($data)){

            if($this->verifPost($data['contenu'])){
                $message = CHAMP_VIDE;
            }else{
                $objetCommentaire = $this->addObjetCommentaire($data);

                $managerCom = new ManagerCommentaire();

                $managerCom->addComBDD($objetCommentaire);
            }

        }

        $message = 'Commentaire envoyé, en attente de validation par le modérateur';

        if (!empty($_GET['num'])) {
            $this->afficheBilletSelect($_GET['num'],$message);
        }

    }

    /**
     * Affiche le billet choisi
     * @throws BilletException
     */

    public function choixBillet(){

        if (!empty($_GET['num'])) {
            $this->afficheBilletSelect($_GET['num']);
        } else {
            $this->afficheListeBillet();
        }
    }

    /**
     * Calcule avec un arrondie supérieur le nombre de pages
     * @param $nbBilletsParpage
     * @return float
     */

    public function nbDePages($nbBilletsParpage){

        $managerBillet = new ManagerBillet();
        $nbTotalBillets = $managerBillet->nbBillets();

        return ceil($nbTotalBillets/$nbBilletsParpage);

    }

    /**
     * Permet de recupere la page actuel en renvoie le premier limit
     * @param $nombreBillets
     * @return float|int
     */

    public function pageActuelle($nombreBillets){

        $pageActuelle= $this->verifPageActuel($nombreBillets);

        $premiereEntree=($pageActuelle-1)*$nombreBillets;

        return $premiereEntree;
    }



    /**
     * Verifie la page sur laquelle nous sommes
     * @param $nombreBillets
     * @return float|int
     */

    public function verifPageActuel($nombreBillets){

        $nombreDePages = $this->nbDePages($nombreBillets);

        if(!empty($_GET['page']))
        {
            $pageActuelle = (int)$_GET['page'];

            if($pageActuelle>$nombreDePages)
            {
               $pageActuelle = $nombreDePages;
            }
        }
        else // Sinon
        {
           $pageActuelle = 1; // La page actuelle est la n°1
        }

        return $pageActuelle;
    }

    /**
     * Verifie que les Champs soient rempli
     * avec Minimum de 3 caracteres
     *
     * @param array $post
     * @return bool
     */
    private function verifPost($postCom){

        $retourPost = false;

        if((strlen(trim($postCom))<3)){
            $retourPost = true;
        }
        return $retourPost;
    }
}





