<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Bichotte Aurelien">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php echo $titre; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
</head>


<body>
<nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
    <a class="navbar-brand" href="./?action=accueil">Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="./?action=accueil">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./?action=listebillets&page=1">Les Billets</a>
            </li>

            <?php if (!isset($_SESSION['connecte'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="./?action=inscription">S'incrire</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./?action=connexion">Se Connecter</a>
            </li>
            <?php endif; ?>


            <?php if (isset($_SESSION['connecte'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="./?action=deconnexion">Se deconnecter</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="./?action=contact">Contact</a>
            </li>


        </ul>
    </div>
</nav>

    <?php echo $contenu ?>

</body>

<footer class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            | <a href="./?action=accueil">Accueil</a> |
            <a href="./?action=listebillet">Les Billets</a> |
            <?php if (!isset($_SESSION['connecte'])) : ?>
            <a href="./?action=inscription">S'incrire</a> |
            <a href="./?action=connexion">Se Connecter</a> |
            <?php endif; ?>
            <a href="./?action=contact">Contact</a> |
            <?php if (isset($_SESSION['connecte'])) : ?>
                <a href="./?action=deconnexion">Se deconnecter</a> |
            <?php endif; ?>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</html>




