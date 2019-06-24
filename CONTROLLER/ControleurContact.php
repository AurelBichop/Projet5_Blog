<?php
/**
 * Class ControleurContact
 * Pour la page contact avec la possibilité de l'envoie d'un mail
 */

class ControleurContact

{

    /**
     * Affiche la page contact
     *
     * @param null $message
     */

    public function affichePageContact($message = null)
    {

        /******************************
        * Création de la Vue en Objet
        ******************************/

        $vue = new Vue('contact', 'Contact');

        $vue->generer(array('message'=>$message));

    }

    /**
     * Methode pour l'envoi de mail
     */

    public function postEmail(){

        $data = $_POST;
        //vérifie les champs
        $errors = $this->verifContact($data);

        // si une erreur existe
        if(!empty($errors)){

            $message = implode('<br />',$errors);

            $message = $this->affMessage($message,'rouge');

            return $this->affichePageContact($message);

        }

        if(!$this->verifCaptcha()){

            $message = 'Captcha invalide';
            return $this->affichePageContact($message);

        }


        //sinon on envoi le mail
         $headers = 'FROM:'.$_POST['email'];
         $message = $_POST['message'];

         mail('aurelien.bichotte@aurelien-bichotte.fr','Formulaire de contact du blog par '.$_POST['name'],$message,$headers);

         $message =  $this->affMessage('mail envoyé','vert');

        return $this->affichePageContact($message);

    }



    /**
     * Permet la vérification des champs pour le contact par email
     *
     * @param array $data // tableau avec les champs du formulaire
     * @return array
     */

    private function verifContact(array $data){

        $errors = array();

        if(!array_key_exists('name',$data) || $data['name'] ==''){
            $errors['name'] = "Vous n'avez pas renseigné votre nom";
        }

        if(!array_key_exists('email',$data) || $data['email'] =='' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Vous n'avez pas renseigné un email valide";
        }

        if(!array_key_exists('message',$data) || $data['message'] ==''){
            $errors['message'] = "Vous n'avez pas renseigné votre message";
        }

        if(!array_key_exists('g-recaptcha-response',$data) || $data['g-recaptcha-response'] ==''){
            $errors['g-recaptcha-response'] = "Vous n'avez pas coché le captha";
        }

        return $errors;
    }

    /**
     * Permet la vérification du captcha
     *
     * @return bool
     */
    private function verifCaptcha(){

        $retour = false;

        // Ma clé privée
        $secret = CLEF_SERVEUR;
        // Paramètre renvoyé par le recaptcha
        $response = $_POST['g-recaptcha-response'];


        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $secret
            . "&response=" . $response;


        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == true) {
            $retour = true;
        }

        return $retour;
    }


    /**
     * Pour afficher le message dans une div avec une couleur
     * fonctionne avec Bootstrap 4
     *
     * @param string $texte
     * @param string $couleur
     * @return string|null
     */
    private function affMessage(string $texte,string $couleur){

        $retour = null;

        if ($couleur === 'vert'){
            $retour = "<div class=\"alert alert-success\">$texte</div>";
        }elseif($couleur = 'rouge'){
            $retour = "<div class=\"alert alert-danger\">$texte</div>";
        }

        return $retour;

    }
}
