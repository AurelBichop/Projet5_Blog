<div class="container">



        <?php if($message) :?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif;?>

    <div class="row">
        <div class="col-sm-8">


            <h1 class="display-3"><strong>Bichotte Aurelien</strong></h1>
            <p>
                <em>
                    Je ne perds jamais. Soit je gagne soit j'apprends.
                    "Nelson Mandela"
                </em>
            </p>

            <p>
                <a href="mailto:linux.aurelien@gmail.com">linux.aurelien@gmail.com</a>
                <a href="https://www.linkedin.com/in/aur%C3%A9lien-b-3b392716b/" target="_blank"><img src="VIEW/images/linkedIn.png" alt="lien linkedin"></a>
            </p>

        </div>

        <div class="col-sm-4">

            <img src="VIEW/images/photo.png" class="img-thumbnail photo_cv" alt="Pas de photos">

        </div>
    </div>





    <div class="row ">
        <div class="col-sm">
            <p>
                <a href="MODELE/cv-bichotte-aurelien.pdf" class="btn btn-primary">Télécharger mon cv </a>
                <a href="./?action=contact" class="btn btn-primary">Me contacter</a>
            </p>
        </div>


    </div>


    <div class="row titre_accueil">
        <div class="col-sm">
            <h2><u>Les derniers articles de mon Blog</u></h2>
        </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">


            <h1 class="display-5"><strong><?php echo htmlspecialchars($lastBillet->getChapeau()); ?></strong></h1>
            <p>
                <em>Edité :

                    <?php

                    echo $lastBillet->getDate().' par '. ucfirst($lastBillet->getNomMembre()).' '.ucfirst($lastBillet->getPreNomMembre());

                    ?>

                </em>
            </p>
            <p>
                <?php echo Utils::Lireplus(htmlspecialchars($lastBillet->getContenu())); ?>
            <p><a class="btn btn-primary btn-lg" href="<?php echo './?action=billet&num='.$lastBillet->getId(); ?>" role="button">Lire plus &raquo;</a></p>

    </div>




        <div class="row">

            <?php

            /***********************************************************
             * Parcours le tableau et affiche les infos de chaque objet *
             ************************************************************/

                foreach ($listeBillet as $unBillet): ?>

                        <div class="col-md-4">
                            <h2><?php echo htmlspecialchars($unBillet->getChapeau()); ?></h2>
                            <p><?php echo Utils::Lireplus(htmlspecialchars($unBillet->getContenu())); ?></p>
                            <p><a class="btn btn-secondary" href="<?php echo './?action=billet&num='.$unBillet->getId(); ?>" role="button"><?php echo $details; ?></a></p>
                        </div>

                <?php endforeach; ?>

        </div>

        <hr>

    </div> <!-- /container -->


