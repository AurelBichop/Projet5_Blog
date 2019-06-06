
<div class="container">

    <?php if($message) :?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif;?>

    <h1>Creation d'un Article</h1>
        <form method="post">

            <div class="form-group"><label>Titre de l'article</label><input type="text" name="chapeau" class="form-control"></div>
            <div class="form-group"><label>Contenu</label><textarea name="contenu" class="form-control" rows="10"></textarea></div>
            <input type="hidden" name="id_membre" value="<?php echo $_SESSION['id'];?>" />
            <button class="btn btn-primary">Sauvegarder</button> <a class="btn btn-success" href="./?action=admin.billet">Retour</a>

        </form>

</div>
