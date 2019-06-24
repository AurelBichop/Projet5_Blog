<div class="container">

    <?php if($message) :?>
        <div class="alert alert-success"><?php echo $message; ?></div>

    <?php else: ?>
    <h1>Nouveaux Commentaires</h1>
    <table class="table">

        <thead>
        <tr>
            <td><strong>ID</strong></td>
            <td><strong>Titre</strong></td>
            <td><strong>Actions</strong></td>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($listeCommentaires as $oneCommentaire): ?>
            <tr>
                <td><?php echo $oneCommentaire->getId(); ?></td>
                <td><?php echo htmlspecialchars($oneCommentaire->getContenu()); ?></td>
                <td>
                    <a class="btn btn-success" href="?action=admin.commentaire.update&id=<?php echo $oneCommentaire->getIdbillet();?>&id_commentaire=<?= $oneCommentaire->getId();?>">Valider</a>

                    <form action="?action=admin.commentaire.delete&id=<?php echo $oneCommentaire->getIdbillet();?>" method="post" style="display:inline">

                        <input type="hidden" name="id_commentaire" value="<?php echo $oneCommentaire->getId(); ?>">

                        <button type="submit" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));">Supprimer</button>
                    </form>

                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>

    </table>

    <?php endif;?>

    <h1>Administrer les articles</h1>

    <p>
        <a href="?action=admin.billet.add" class="btn btn-success">Ajouter</a>
    </p>


    <table class="table">

        <thead>
        <tr>
            <td><strong>ID</strong></td>
            <td><strong>Titre</strong></td>
            <td><strong>Actions</strong></td>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($listeBillets as $oneBillet): ?>
            <tr>
                <td><?php echo $oneBillet->getId(); ?></td>
                <td><?php echo htmlspecialchars($oneBillet->getChapeau()); ?></td>
                <td>
                    <a class="btn btn-primary" href="?action=admin.billet.edit&id=<?= $oneBillet->getId();?>">Editer</a>

                    <a class="btn btn-success" href="?action=admin.billet.commentaire&id=<?= $oneBillet->getId();?>">Les commentaires</a>
                    <form action="?action=admin.billet.delete" method="post" style="display:inline">

                        <input type="hidden" name="id" value="<?= $oneBillet->getId(); ?>">

                        <button type="submit" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet article ?'));">Supprimer</button>
                    </form>

                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>

    </table>


    <div>
        <div class="col-md-auto mb-5">
            <?php for($i = 1;$i<=$pages;$i++): ?>

                <a class="btn btn-primary" href="<?php echo './?action=admin.billet&page='.$i; ?>">Page <?php echo $i; ?> </a>

            <?php endfor; ?>
        </div>
    </div>

</div>