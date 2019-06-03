<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><strong><?php echo htmlspecialchars($Billet->getChapeau()); ?></strong></h1>
            <p>
                <time>Date :

                    <?php

                    $date = new DateTime($Billet->getDate());

                    echo $date->format('d-m-Y à H:i').' par '. ucfirst(htmlspecialchars($Billet->getNomMembre())).' '.ucfirst(htmlspecialchars($Billet->getPreNomMembre()));

                    ?>

                </time>
            </p>

        </div>
    </div>


    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
                <div class="col-md-auto">

                      <p><?php echo htmlspecialchars($Billet->getContenu()); ?></p>

                </div>


        </div>

        <?php

        if (!empty($Commentaires))
        {
            ?>
            <h4>Commentaires :</h4>
            <?php

            foreach ($Commentaires as $com):

                $dateCom = new DateTime($com->getDateheure());

                ?>

                <div class="alert alert-primary">
                    <h5><?php echo 'Ecrit par '.htmlspecialchars($com->getNom()).' '.htmlspecialchars($com->getPrenom()); ?></h5>
                    <em><?php echo 'Le '.$dateCom->format('d-m-Y à H:i'); ?></em>
                    <div class="alert">
                        <?php echo nl2br(htmlspecialchars($com->getContenu())); ?>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php
        }
        ?>



        <?php if(isset($_SESSION['connecte'])): ?>

            <h4>Laisser un commentaire</h4>
        <form action="./?action=newcommentaire&num=<?php echo $Billet->getId(); ?>" method="post">
            <div class="form-group">
                <label for="postCommentaire"><?php echo ucfirst($_SESSION['nom']).' '.ucfirst($_SESSION['prenom']).' le '.date('d-m-Y') ?></label>

                    <textarea id="postCommentaire" class="form-control" rows="" name="contenu"></textarea>
                    <input type="hidden" name="id_billet" value="<?php echo $Billet->getId();?>" />
                    <input type="hidden" name="id_membre" value="<?php echo $_SESSION['id'];?>" />
            </div>
            <div class="form-group">
                <button type=submit class="btn btn-primary">Envoyer</button></div>
            <div class="form-group"><input type="hidden" id="hidden" name="hidden"></div>
        </form>

        <?php endif; ?>

    </div> <!-- /container -->





</main>
