<div class="container">

    <?php if($message) :?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif;?>

    <h1>Edition d'un Article</h1>
    <form method="post">

        <div class="form-group"><label>Titre de l'article</label><input type="text" name="chapeau" class="form-control" value="<?php echo $billet->getChapeau(); ?>"></div>
        <div class="form-group"><label>Contenu</label><textarea name="contenu" class="form-control" rows="10"><?php echo $billet->getContenu(); ?></textarea></div>
        <input type="hidden" name="id_membre" value="<?php echo $_SESSION['id'];?>" />
        <input type="hidden" name="id" value="<?php echo $billet->getId();?>" />
        <button class="btn btn-primary">Sauvegarder</button> <a class="btn btn-success" href="./?action=admin.billet">Retour</a>

    </form>

</div>
