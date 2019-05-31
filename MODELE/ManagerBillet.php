<?php
/**
 * Classe Pour manager les billets en Bdd qui herite de la classe abstraite AbstractManager
 *
 */


class ManagerBillet extends AbstractManager
{

    /**
     * @param int $debut
     * @param int $fin
     * @return object
     */

    public function getBillets(int $debut = null, int $fin = null)
{

    $sql = null;

    $debut = (int)$debut;
    $fin = (int)$fin;

    if (($debut === null) || ($fin === null)){

        $sql = $this->listAllBillet();
    }else
    {
        $sql = "SELECT id, id_membre, chapeau, contenu, date FROM billet ORDER BY billet.id DESC limit $debut, $fin";
    }

    //$sql = "SELECT id, id_membre, chapeau, contenu, date FROM billet ORDER BY billet.id DESC limit $debut, $fin";
    $reponse = $this->executerRequete($sql);

    while ($donnees = $reponse->fetch())
    {
        $objetBillet[] = new Billet($donnees);
    }

    return $objetBillet;

}

    /**
     * @return Billet
     *
     */

    public function getLastBillets()
    {

        $sql = 'SELECT id, id_membre, chapeau, contenu, date FROM billet ORDER BY id DESC LIMIT 1';
        $reponse = $this->executerRequete($sql);

        $donnee = $reponse->fetch();

        $objetBillet = new Billet($donnee);

        return $objetBillet;

    }


    /**
     * @param int $id_billet
     * @return object
     */

    public function getBilletSelect(int $id_billet)
    {

        $sql = "SELECT id, id_membre, chapeau, contenu, date FROM billet WHERE id=:id";

        $billet = [
            'id' => $id_billet
        ];

        $reponse = $this->executerRequete($sql,$billet);

        $donnee = $reponse->fetch();

        $objetBillet = new Billet($donnee);

        return $objetBillet;

    }


    private function listAllBillet(){

        $sql = "SELECT id, id_membre, chapeau, contenu, date FROM billet ORDER BY billet.id DESC";
        return $sql;
    }


    public function nbBillets(){

        $sql ="SELECT COUNT(*) AS nb_billets FROM billet";
        $reponse = $this->executerRequete($sql);

        $nbBillets = $reponse->fetch();
        $nbBilletsInt = (int)$nbBillets['nb_billets'];

        return $nbBilletsInt;
    }

    public function billetPagination($premiereEntre, $billetsParPage){

        $sql = $this->listAllBillet();

        $objetBillet = array();

        $premiereEntre = (int)$premiereEntre;
        $billetsParPage = (int)$billetsParPage;

        $sql.= " LIMIT $premiereEntre, $billetsParPage";
        $reponse = $this->executerRequete($sql);

        while ($donnees = $reponse->fetch())
        {
            $objetBillet[] = new Billet($donnees);
        }


        return $objetBillet;


    }

}