<?php


class ManagerCommentaire extends AbstractManager
{

    public function getCommentaire($idBillet, int $valid = 0)
    {

        $objetCommentaire = [];

        $sql = "SELECT C.*, M.nom, M.prenom 
                FROM commentaire AS C
                INNER JOIN membre AS M 
                ON C.id_membre = M.id
                WHERE C.id_billet=:id
                AND C.validation=:validation
                ORDER BY C.id DESC";

        $billet = [
            'id' => $idBillet,
            'validation' => $valid
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

    public function updateCom($idCom){

        $idCom = (int)$idCom;

        $sql= 'UPDATE commentaire SET validation=1 WHERE id=:idCom';

        $this->executerRequete($sql, array('idCom'=>$idCom));
    }


    public function deleteCommentaireBDD($idCommentaire){
        $idCommentaire = (int)$idCommentaire;

        $commentaire = [
            'idCommentaire' => $idCommentaire
        ];

        $sql= 'DELETE FROM commentaire WHERE commentaire.id=:idCommentaire';

        $this->executerRequete($sql, $commentaire);
    }

}