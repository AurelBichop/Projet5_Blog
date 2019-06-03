
<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <?php foreach ($listeBillets as $oneBillet): ?>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><strong><?php echo htmlspecialchars($oneBillet->getChapeau()); ?></strong></h1>
<p>
    <em>Date :

        <?php

        echo $oneBillet->getDate().' par '. ucfirst($oneBillet->getNomMembre()).' '.ucfirst($oneBillet->getPreNomMembre());

        ?>

    </em>
</p>
<p>
    <?php echo Utils::Lireplus(htmlspecialchars($oneBillet->getContenu())).'.'; ?>
<p><a class="btn btn-primary btn-lg" href="<?php echo './?action=billet&num='.$oneBillet->getId(); ?>" role="button">Lire plus &raquo;</a></p>
</div>
</div>
<?php endforeach; ?>

    <div class="row justify-content-md-center">
        <div class="col-md-auto mb-5">
        <?php for($i = 1;$i<=$pages;$i++): ?>

            <a class="btn btn-primary" href="<?php echo './?action=listebillets&page='.$i; ?>">Page <?php echo $i; ?> </a>

        <?php endfor; ?>
        </div>
    </div>


