<?php


class ControleurMonCompte
{

    public function afficheMonCompte(){

        $message=null;

        $managerMembre = new ManagerMembre();

        $membre = $managerMembre->getOneMembre($_SESSION['email']);

        $vue = new Vue('compte', 'Mon Compte');

        $vue->generer(array('membre'=>$membre,'message'=>$message));
    }


    

}