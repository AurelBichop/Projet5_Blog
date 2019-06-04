<?php

class ManagerMembre extends AbstractManager
{

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

}