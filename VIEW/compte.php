<div class="container">

    <?php if($message) :?>
        <div class="alert alert-success"><?php echo $message; ?></div>

    <?php endif;?>

    <h1>Mes Informations</h1>
    <form method="post" action="./?action=moncompte.update" enctype="multipart/form-data">

        <div class="row">
            <div class="col-3">
                <div class="card">
                    <img src="VIEW/images/avatar_<?php echo $membre->getID(); ?>" class="img-thumbnail" alt="Photo de Profile">

                </div>

            </div>
            <div class="form-group">
                <input type="file" name="avatar" id="avatar" class="form-control-file border" />
            </div>

        </div>



        <input type="hidden" name="id" value="<?php echo $membre->getID(); ?>" />

        <div class="form-group"><label>Nom</label><input type="text" name="nom" class="form-control" value="<?php echo $membre->getNom(); ?>"></div>
        <div class="form-group"><label>Prenom</label><input type="text" name="prenom" class="form-control" value="<?php echo $membre->getPrenom(); ?>"></div>
        <div class="form-group"><label>Courriel</label><input type="text" name="courriel" class="form-control" value="<?php echo $membre->getCourriel(); ?>"></div>

        <button class="btn btn-primary">Sauvegarder</button> <a class="btn btn-success" href="./?action=accueil">Retour</a>

    </form>

</div>
