
<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <?php foreach ($listeBillets as $oneBillet): ?>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><?php echo $oneBillet->getId() .' <strong>' . htmlspecialchars($oneBillet->getChapeau()) . '</strong>'; ?></h1>
<p>
    <time>Date :

        <?php

        $date = new DateTime($oneBillet->getDate());

        echo $date->format('d-m-Y à H:i').' ecrit par '. $oneBillet->getIdmembre();

        ?>

    </time>
</p>
<p>
    <?php echo Utils::Lireplus(htmlspecialchars($oneBillet->getContenu())).'.'; ?>
<p><a class="btn btn-primary btn-lg" href="<?php echo './?action=billet&num='.$oneBillet->getId(); ?>" role="button">Lire plus &raquo;</a></p>
</div>
</div>
<?php endforeach; ?>