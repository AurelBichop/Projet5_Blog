<div class="container">

    <?php if($message) :?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif;?>

<h1>Administrer les commentaires du billet</h1>

<table class="table">

    <thead>
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Contenu</strong></td>
        <td><strong>Actions</strong></td>
    </tr>
    </thead>

    <tbody>

    <?php foreach ($listeCommentaires as $oneCommentaire): ?>
        <tr>
            <td><?php echo $oneCommentaire->getId(); ?></td>
            <td><?php echo htmlspecialchars($oneCommentaire->getContenu()); ?></td>
            <td>

                <form action="?action=admin.commentaire.delete&id=<?php echo $oneCommentaire->getIdbillet();?>" method="post" style="display:inline">

                    <input type="hidden" name="id_commentaire" value="<?= $oneCommentaire->getId(); ?>">

                    <button type="submit" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));">Supprimer</button>
                </form>

            </td>
        </tr>


    <?php endforeach; ?>

    </tbody>

</table>

</div>