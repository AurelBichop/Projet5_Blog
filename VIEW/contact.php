<div class="container">

    <?php if($message) :?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif;?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">PAGE CONTACT</h1>
        <p class="lead text-muted mb-0">Page Contact de mon Blog</p>
    </div>
</section>

    <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Me contacter
                    </div>
                    <div class="card-body">
                        <form action="./?action=contact.postEmail" method="POST">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" placeholder="Votre nom">
                            </div>
                            <div class="form-group">
                                <label for="email">Courriel</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" placeholder="Votre courriel">

                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" id="message" rows="6" placeholder="Votre message"><?php if(isset($_POST['message'])){ echo $_POST['message']; } ?></textarea>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6Ld-0qgUAAAAAGT5GsEnGEX_unWvYPHcXIrMlleS"></div>
                            </div>

                            <div class="mx-auto">
                            <button type="submit" class="btn btn-primary text-right">Envoyer</button></div>
                        </form>
                    </div>
                </div>
            </div>
     </div>
</div>
