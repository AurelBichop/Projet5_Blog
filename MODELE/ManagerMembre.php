<?php
/**
 * Class ManagerMembre
 * Pour manager les membres en Base de données,
 * Cette classe herite de la classe abstraite AbstractManager
 */

class ManagerMembre extends AbstractManager
{

    /**
     * Permet d'obtenir un tableau avec tout les membre déja enregistré
     *
     * @return array // avec les objets membres
     */
    public function getMembres()
    {

        $sql = "SELECT nom, password FROM membre";
        $reponse = $this->executerRequete($sql);

        while ($donnees = $reponse->fetch())
        {
            $objetMembre[] = new Membre($donnees);
        }

        return $objetMembre;

    }

    /**
     * Ajoute un membre
     * @param membre $membre
     */
    public function addBDD(membre $membre)
    {

        $dataMembre = array(
            'nom'=>$membre->getNom(),
            'prenom'=>$membre->getPrenom(),
            'courriel'=>$membre->getCourriel(),
            'password'=>password_hash($membre->getPassword(), PASSWORD_DEFAULT, ['cost' => 12])
        );

        $sql = 'INSERT INTO membre (is_administrateur, nom, prenom, courriel, password, date_inscription) VALUES (0, :nom, :prenom, :courriel, :password, NOW())';
        $this->executerRequete($sql, $dataMembre);
    }

    /**
     * Recupere un membre avec son adresse de Courriel
     *
     * @param $dataMail
     * @return Membre
     * @throws LoginException
     */
    public function getOneMembre($dataMail)
    {
        $sql = "SELECT * FROM membre WHERE courriel=:mail";

        $mail = [
            'mail' => $dataMail
        ];

        $reponse = $this->executerRequete($sql,$mail);

        $verifBol = $reponse->fetch();

        if($verifBol === false){
            throw new LoginException();
        }

        $membre = new Membre($verifBol);

        return $membre;
    }

    /**
     * Verifie que le courriel n'est pas déja enregistré
     *
     * @param $email
     * @return bool
     */
    public function verifMail($email){

        $sql = "SELECT courriel FROM membre WHERE courriel=:mail";

        $mail = [
            'mail' => $email
        ];

        $reponse =$this->executerRequete($sql,$mail);
        $verif = $reponse->fetch();

        if ($verif === false){
            return true;
        }

        return false;
    }

    /**
     * Pour mettre a jour les informations d'un membre
     *
     * @param Membre $membre
     */
    public function updateMembre(Membre $membre){

        $dataMembre = array(
            'idMembre'=>$membre->getId(),
            'nom'=>$membre->getNom(),
            'prenom'=>$membre->getPrenom(),
            'courriel'=>$membre->getCourriel()
        );

        $sql= 'UPDATE membre SET nom=:nom, prenom=:prenom, courriel=:courriel WHERE id=:idMembre';

        $this->executerRequete($sql, $dataMembre);
    }

}