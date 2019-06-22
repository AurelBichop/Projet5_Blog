

<div class="container mb-4">
    <?php if($message) :?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endif;?>
    <h1>Formulaire Nouveau Membre</h1>


    <form action="./?action=newinscription" method="post">
        <div class="form-group">
            <label>Nom</label> *
            <input type="text" id="nom" name="nom" value="<?php if(isset($_POST['nom'])){ echo $_POST['nom']; } ?>" class="form-control" placeholder="votre Nom">
        </div>
            <div class="form-group">
                <label>Prénom</label> *
                <input type="text" id="prenom" name="prenom" value="<?php if(isset($_POST['prenom'])){ echo $_POST['prenom']; } ?>" class="form-control" placeholder="votre Prenom">
            </div><div class="form-group">
            <label>Courriel</label> *
            <input type="text" id="email" name="courriel" value="<?php if(isset($_POST['courriel'])){ echo $_POST['courriel']; } ?>" class="form-control" placeholder="votre courriel">
        </div>
        <div class="form-group">
            <label>Mot de passe</label> *
            <input type="password" id="pass" name="password" value="" class="form-control" placeholder="votre mot de passe">
        </div>
        <div class="form-group">
            <label>Vérification du mot de passe</label> *
            <input type="password" id="verif" name="verif" value="" class="form-control" placeholder="rentrez à nouveau votre mot de passe">
        </div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="<?php echo CLEF_CLIENT; ?>"></div>
            </div>
        <div class="form-group">
            <button type=submit class="btn btn-primary">S'incrire</button>
        </div>
    </form>
</div>
