<?php

/**
 * Class Vue
 * Permet l'affichage des Vues du blog
 */
Class Vue

{
    // Nom du fichier associé à la vue
    private $fichier;
    // Titre de la vue (défini dans le fichier vue)
    private $titre;

    public function __construct($action, $titre) {
        // Détermination du nom du fichier vue à partir de l'action
        $this->fichier = "VIEW/" . $action . ".php";
        $this->setTitre($titre);

    }


    /**
     * Génère et affiche la vue
     *
     * @param $donnee
     * @throws Exception
     */
    public function generer($donnee) {
        // Génération de la partie spécifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnee);
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('VIEW/template.php',
            array('titre' => $this->titre, 'contenu' => $contenu));
        // Renvoi de la vue au navigateur
        echo $vue;
    }


    /**
     * Génère un fichier vue et renvoie le résultat produit
     *
     * @param $fichier
     * @param $data
     * @return false|string
     * @throws Exception
     */
    private function genererFichier($fichier, $data) {
        if (file_exists($fichier)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            //print_r($donnees);
            extract($data);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $fichier;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$fichier' introuvable");

        }
    }

    /**
     * Pour le titre de la page
     *
     * @param string $titre
     * return void
     */

    public function setTitre(string $titre)
    {
        $this->titre = $titre;
    }

}