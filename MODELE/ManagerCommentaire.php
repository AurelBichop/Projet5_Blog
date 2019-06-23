<?php

/**
 * Classe Pour manager les commentaire en Base de données,
 * Cette classe herite de la classe abstraite AbstractManager
 *
 */
class ManagerCommentaire extends AbstractManager
{

    /**
     * Récupere les commentaires valide pour un article choisi
     *
     * @param $idBillet
     * @param int $valid
     * @return array
     */
    public function getCommentaire($idBillet = null, int $valid = 0)
    {

        $objetCommentaire = [];

        $sql =null;

        if($idBillet == null){
            $sql = "SELECT C.*, M.nom, M.prenom 
                FROM commentaire AS C
                INNER JOIN membre AS M 
                ON C.id_membre = M.id
                WHERE C.validation=:validation
                ORDER BY C.id";

            $billet = [
                'validation' => $valid
            ];

        }else{
            $sql = "SELECT C.*, M.nom, M.prenom 
                FROM commentaire AS C
                INNER JOIN membre AS M 
                ON C.id_membre = M.id
                WHERE C.id_billet=:id
                AND C.validation=:validation
                ORDER BY C.id";

            $billet = [
                'id' => $idBillet,
                'validation' => $valid
            ];
        }




        $reponse = $this->executerRequete($sql,$billet);

        while ($donnees = $reponse->fetch())
        {
            $objetCommentaire[] = new Commentaire($donnees);
        }

        return $objetCommentaire;

    }

    /**
     * Enregistre le commentaire non validé
     *
     * @param Commentaire $commentaire
     */
    public function addComBDD(Commentaire $commentaire)
    {

        if ($commentaire->getIdbillet() !== null)
        {
            $dataCommentaire = array(
                'idBillet'=>$commentaire->getIdBillet(),
                'idMembre'=>$commentaire->getIdMembre(),
                'contenu'=>$commentaire->getContenu()
            );

            $sql= 'INSERT INTO commentaire (id_billet, id_membre, contenu, date_heure) VALUES (:idBillet, :idMembre, :contenu, NOW())';
            $this->executerRequete($sql, $dataCommentaire);
        }

    }

    /**
     * Change l'etat du commentaire
     *
     * @param $idCom
     */
    public function updateCom($idCom){

        $idCom = (int)$idCom;

        $sql= 'UPDATE commentaire SET validation=1 WHERE id=:idCom';

        $this->executerRequete($sql, array('idCom'=>$idCom));
    }

    /**
     * Supprime le commentaire choisi
     *
     * @param $idCommentaire
     */
    public function deleteCommentaireBDD($idCommentaire){
        $idCommentaire = (int)$idCommentaire;

        $commentaire = [
            'idCommentaire' => $idCommentaire
        ];

        $sql= 'DELETE FROM commentaire WHERE commentaire.id=:idCommentaire';

        $this->executerRequete($sql, $commentaire);
    }

}