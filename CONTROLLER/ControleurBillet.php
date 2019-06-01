<?php


class ControleurBillet
{

    public function afficheListeBillet()
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
            'details'=>'Voir détails &raquo;'
             ));

    }

    /**
     * Affichage de la liste de tous les billets paginé
     */


    public function afficheBilletPagination(){

        $managerBillet = new ManagerBillet();

        $nombreBillets = 3;

        $allBillets = $managerBillet->billetPagination($this->pageActuelle($nombreBillets),$nombreBillets);

        $nbDePage = ceil($managerBillet->nbBillets()/$nombreBillets);

        $vue = new Vue('listeBillets', 'Billets');

        $vue->generer(array(
            'listeBillets' => $allBillets,
            'pages'=>$nbDePage
        ));

    }

    /**
     * Affiche le billet selectionné
     * @param $id_billet
     * @throws BilletException
     */

    public function afficheBilletSelect($id_billet)
    {
        $id_billet = (int)$id_billet;

        if (!(int)$id_billet){
            throw new BilletException();
        }

        $managerBillets = new ManagerBillet();
        $managerCommentaire = new ManagerCommentaire();

        $BilletSelect = $managerBillets->getBilletSelect($id_billet);
        $commentairesBilletSelect = $managerCommentaire->getCommentaire($BilletSelect->getID());


        $numBilletSelect = 'Billet N '.$BilletSelect->getID(). ' ' . $BilletSelect->getChapeau();

        $vue = new Vue('billet', $numBilletSelect);

        $vue->generer(array(
            'Billet' =>$BilletSelect,
            'Commentaires'=>$commentairesBilletSelect
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

        $objetCommentaire = $this->addObjetCommentaire($data);

        $managerCom = new ManagerCommentaire();

        $managerCom->addComBDD($objetCommentaire);

        if (!empty($_GET['num'])) {
            $this->afficheBilletSelect($_GET['num']);
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


}





