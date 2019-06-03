<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><strong><?php echo htmlspecialchars($lastBillet->getChapeau()); ?></strong></h1>
            <p>
                <time>Edité :

                    <?php

                    $date = new DateTime($lastBillet->getDate());

                    echo $date->format('d-m-Y à H:i').' par '. ucfirst($lastBillet->getNomMembre()).' '.ucfirst($lastBillet->getPreNomMembre());

                    ?>

                </time>
            </p>
            <p>
                <?php echo Utils::Lireplus(htmlspecialchars($lastBillet->getContenu())).'.'; ?>
            <p><a class="btn btn-primary btn-lg" href="<?php echo './?action=billet&num='.$lastBillet->getId(); ?>" role="button">Lire plus &raquo;</a></p>
        </div>
    </div>


    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

            <?php

            /***********************************************************
             * Parcours le tableau et affiche les infos de chaque objet *
             ************************************************************/

                foreach ($listeBillet as $unBillet): ?>

                        <div class="col-md-4">
                            <h2><?php echo htmlspecialchars($unBillet->getChapeau()); ?></h2>
                            <p><?php echo Utils::Lireplus(htmlspecialchars($unBillet->getContenu())).'.'; ?></p>
                            <p><a class="btn btn-secondary" href="<?php echo './?action=billet&num='.$unBillet->getId(); ?>" role="button"><?php echo $details; ?></a></p>
                        </div>

                <?php
                 endforeach;
                 ?>

        </div>

        <hr>

    </div> <!-- /container -->

</main>
