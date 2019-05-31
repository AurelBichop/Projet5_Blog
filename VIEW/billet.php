<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><?php echo $Billet->getId() .' <strong>' . htmlspecialchars($Billet->getChapeau()) . '</strong>'; ?></h1>
            <p>
                <time>Date :

                    <?php

                    $date = new DateTime($Billet->getDate());

                    echo $date->format('d-m-Y à H:i').' ecrit par '. $Billet->getIdmembre();

                    ?>

                </time>
            </p>

        </div>
    </div>


    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
                <div class="col-md-auto">

                      <p><?php echo $Billet->getContenu(); ?></p>

                </div>


        </div>

        <?php

        if (!empty($Commentaires))
        {
            ?>
            <h4>Commentaires :</h4>
            <?php

            foreach ($Commentaires as $com){
                echo "<div class=\"alert alert-primary\" role=\"alert\">".$com->getContenu()."</div>";
            }
        }

        ?>



        <?php if(isset($_SESSION['connecte'])): ?>

            <h4>Laisser un commentaire</h4>
        <form action="./?action=newcommentaire&num=<?php echo $Billet->getId(); ?>" method="post">
            <div class="form-group">
                <label for="postCommentaire"><?php echo $_SESSION['nom'].' le '.date('d-m-Y') ?></label>

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
