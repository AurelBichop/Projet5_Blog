

<div class="container mb-4">
    <h1>Formulaire Nouveau Membre</h1>


    <form action="./?action=newinscription" method="post">
        <div class="form-group">
            <label>Nom</label> *
            <input type="texte" id="nom" name="nom" value="" class="form-control" placeholder="votre Nom">
        </div><div class="form-group">
            <div class="form-group">
                <label>Prenom</label> *
                <input type="texte" id="prenom" name="prenom" value="" class="form-control" placeholder="votre Prenom">
            </div><div class="form-group">
            <label>Courriel</label> *
            <input type="email" id="email" name="courriel" value="" class="form-control" placeholder="votre courriel">
        </div>
        <div class="form-group">
            <label>Mot de passe</label> *
            <input type="password" id="pass" name="password" value="" class="form-control" placeholder="votre mot de passe">
        </div>
        <div class="form-group">
            <label>Verification du mot de passe</label> *
            <input type="password" id="verif" name="verif" value="" class="form-control" placeholder="rentez a nouveau votre mot de passe">
        </div>
        <div class="form-group">
            <button type=submit class="btn btn-primary">S'incrire</button></div>
        <div class="form-group"><input type="hidden" id="hidden" name="hidden"></div>
    </form>
</div>
