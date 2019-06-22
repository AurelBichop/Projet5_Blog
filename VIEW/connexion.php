<div class="container">
    <?php if($message) :?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif;?>
    <h1>Connexion</h1>


    <form action="./?action=newconnection" method="post">
        <div class="form-group">
            <label>Email</label>*
            <input type="text" id="nom" name="login" value="" class="form-control">
        </div>
        <div class="form-group">
            <label>Mot de passe</label>*
            <input type="password" id="password" name="password" value="" class="form-control">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="connexionAutomatique" name="connexionAutomatique">
            <label class="form-check-label" for="connexionAutomatique">Connexion Automatique</label>
        </div>

        <br />

        <div class="form-group">
            <button type=submit class="btn btn-primary">connexion</button></div>
    </form>

</div>