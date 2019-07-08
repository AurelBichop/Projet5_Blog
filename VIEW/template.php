<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="projet 5 openclassrooms">
    <meta name="author" content="Bichotte Aurelien">

    <title><?php echo $titre; ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="http://aurelien-bichotte.fr/projet3/images/logo_fav.png" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- CSS aditionnel -->
    <link rel="stylesheet" type="text/css" href="VIEW/css/style.css" />

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>


<body>
<nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
    <a class="navbar-brand" href="./?action=accueil">Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
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

            <?php if (isset($_SESSION['connecte'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="./?action=moncompte">Mon Compte</a>
                </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['administrateur']) && ($_SESSION['administrateur']==1)): ?>
                <li class="nav-item">
                    <a class="nav-link" href="./?action=admin.billet">Administrer</a>
                </li>
            <?php endif; ?>


        </ul>
    </div>
</nav>

    <?php echo $contenu ?>

<footer class="container menu_bas">
    <div class="row justify-content-md-center">
        <div class="col-auto">
            <p class="text-center">
                | <a href="./?action=accueil">Accueil</a> |
                <a href="./?action=listebillet">Les Billets</a> |

                <?php if (!isset($_SESSION['connecte'])) : ?>
                    <a href="./?action=inscription">S'incrire</a> |
                    <a href="./?action=connexion">Se Connecter</a> |
                <?php endif; ?>

                <a href="./?action=contact">Contact</a> |

                <?php if (isset($_SESSION['connecte'])) : ?>
                    <a href="./?action=moncompte">Mon Compte</a> |
                    <a href="./?action=deconnexion">Déconnection</a> |
                <?php endif; ?>

                <?php if (isset($_SESSION['administrateur']) && ($_SESSION['administrateur']==1)): ?>
                    <a href="./?action=admin.billet">Administrer</a>
                <?php endif; ?>
            </p>


        </div>
    </div>
</footer>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>

</html>




