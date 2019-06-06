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
    $objetBillet = array();

    $debut = (int)$debut;
    $fin = (int)$fin;

    if (($debut === null) || ($fin === null)){

        $sql = $this->listAllBillet();
    }else
    {
        $sql = "SELECT id, id_membre, chapeau, contenu, date FROM billet ORDER BY billet.id DESC limit $debut, $fin";
    }

    $reponse = $this->executerRequete($sql);

    while ($donnees = $reponse->fetch())
    {
        $objetBillet[] = new Billet($donnees);
    }

    return $objetBillet;

    }


    /**
     * @return Billet
     * @throws BilletException
     */

    public function getLastBillets()
    {

        $sql = 'SELECT B.id, B.id_membre, M.nom, M.prenom, B.chapeau, B.contenu, B.date 
                FROM billet AS B
                INNER JOIN membre AS M
				ON B.id_membre = M.id
                ORDER BY id 
                DESC LIMIT 1';

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

        $sql = "SELECT B.id, B.id_membre, M.nom, M.prenom, B.chapeau, B.contenu, B.date 
                FROM billet AS B
                INNER JOIN membre AS M
				ON B.id_membre = M.id
				WHERE B.id=:id
				";

        $billet = [
            'id' => $id_billet
        ];

        $reponse = $this->executerRequete($sql,$billet);

        $donnee = $reponse->fetch();

        $objetBillet = new Billet($donnee);

        return $objetBillet;

    }


    private function listAllBillet(){

        $sql = "SELECT B.id, B.id_membre, M.nom, M.prenom, B.chapeau, B.contenu, B.date 
                FROM billet AS B
                INNER JOIN membre AS M
				ON B.id_membre = M.id
                ORDER BY B.id 
                DESC";

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

    public function addBilletBDD(Billet $billet)
    {

            $dataBillet = array(
                'idMembre'=>$billet->getIdmembre(),
                'chapeau'=>$billet->getChapeau(),
                'contenu'=>$billet->getContenu()
            );

            $sql= 'INSERT INTO billet (id_membre, chapeau, contenu, date) VALUES (:idMembre, :chapeau, :contenu, NOW())';

            $this->executerRequete($sql, $dataBillet);

    }


    public function UpdateBilletBDD(Billet $billet)
    {

        $dataBillet = array(
            'idBillet'=>$billet->getId(),
            'idMembre'=>$billet->getIdmembre(),
            'chapeau'=>$billet->getChapeau(),
            'contenu'=>$billet->getContenu()
        );

        $sql= 'UPDATE billet SET id_membre=:idMembre, chapeau=:chapeau, contenu=:contenu, date=NOW() WHERE id=:idBillet';


        $this->executerRequete($sql, $dataBillet);

    }

    public function deleteBilletBDD(int $idBillet){

        $idBillet = (int)$idBillet;

        $billet = [
            'idBillet' => $idBillet
        ];

        $sql= 'DELETE FROM billet WHERE billet.id=:idBillet';

        $this->executerRequete($sql, $billet);
    }



}