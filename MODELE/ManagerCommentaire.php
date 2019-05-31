<?php

require_once 'AbstractManager.php';


class ManagerCommentaire extends AbstractManager
{

    public function getCommentaire($idBillet)
    {

        $objetCommentaire = [];

        $sql = "SELECT * FROM commentaire WHERE id_billet=:id";

        $billet = [
            'id' => $idBillet
        ];

        $reponse = $this->executerRequete($sql,$billet);

        while ($donnees = $reponse->fetch())
        {
            $objetCommentaire[] = new Commentaire($donnees);
        }

        return $objetCommentaire;

    }

    public function addComBDD(Commentaire $commentaire)
    {

        if ($commentaire->getIdbillet() !== null)
        {
            $dataCommentaire = array(
                'idBillet'=>$commentaire->getIdbillet(),
                'idMembre'=>$commentaire->getIdmembre(),
                'contenu'=>$commentaire->getContenu()
            );

            $sql= 'INSERT INTO commentaire (id_billet, id_membre, contenu, date_heure) VALUES (:idBillet, :idMembre, :contenu, NOW())';
            $this->executerRequete($sql, $dataCommentaire);
        }

    }

}