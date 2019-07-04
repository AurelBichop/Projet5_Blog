<div class="container">


    <div class="col-12">
        <?php if($message) :?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif;?>

    <!-- Main jumbotron for a primary marketing message or call to action -->

    <div class="jumbotron">

            <h4><strong><?php echo htmlspecialchars($Billet->getChapeau()); ?></strong></h4>
            <p>
                <em>Date :

                    <?php

                    echo $Billet->getDate().' par '. ucfirst(htmlspecialchars($Billet->getNomMembre())).' '.ucfirst(htmlspecialchars($Billet->getPreNomMembre()));

                    ?>

                </em>
            </p>

        </div>
    </div>


    <div class="col-12">
        <!-- Example row of columns -->
        <div class="row">
                <div class="col-md-auto">

                      <p><?php echo nl2br(htmlspecialchars($Billet->getContenu())); ?></p>

                </div>


        </div>

        <?php

        if (!empty($Commentaires)): ?>

            <h4>Commentaires :</h4>

            <?php foreach ($Commentaires as $com): ?>

                <div class="alert alert-primary">
                    <h5><?php echo 'Ecrit par '.htmlspecialchars($com->getNom()).' '.htmlspecialchars($com->getPrenom()); ?></h5>
                    <em><?php echo 'Le '.$com->getDate(); ?></em>
                    <div class="alert">

                        <img src="VIEW/images/avatar_<?php echo $com->getIdMembre(); ?>.png" class="img-thumbnail photo_compte" alt="Pas de photos" />

                        <p><?php echo nl2br(htmlspecialchars($com->getContenu())); ?></p>

                    </div>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <?php if(!isset($_SESSION['connecte'])): ?>
            <div>
                <h5>Pour Laisser un commentaire merci de vous inscrire ou connecter</h5>
                <a href="./?action=connexion"><button class="btn btn-primary">Connexion</button></a>

                <a href="./?action=inscription"><button class="btn btn-primary">Inscription</button></a>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['connecte'])): ?>

            <h4>Laisser un commentaire</h4>
        <form action="./?action=newcommentaire&num=<?php echo $Billet->getId(); ?>" method="post">
            <div class="form-group">
                <label for="postCommentaire"><?php echo ucfirst($_SESSION['nom']).' '.ucfirst($_SESSION['prenom']).' le '.date('d-m-Y') ?></label>

                    <textarea id="postCommentaire" class="form-control" name="contenu"></textarea>
                    <input type="hidden" name="id_billet" value="<?php echo $Billet->getId();?>" />
                    <input type="hidden" name="id_membre" value="<?php echo $_SESSION['id'];?>" />
            </div>
            <div class="form-group">
                <button type=submit class="btn btn-primary">Envoyer</button></div>
            <div class="form-group"><input type="hidden" id="hidden" name="hidden"></div>
        </form>

        <?php endif; ?>

    </div>
    <!-- /container -->
</div>




