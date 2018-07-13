<!doctype html>

<html>
<head>
    <title>DATÀC – Connexion</title>
    <meta charset="utf-8" />
    <link rel = "stylesheet" href = ".././bootstrap/css/bootstrap.css"/>
    <link rel = "stylesheet" href = ".././bootstrap/css/bootstrap-theme.css"/>
    <link rel = "stylesheet" href = "msf_interne.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
<!--container : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...)-->
<div class="container">

    <div class="row">
        <img id="logoNonConnect" class="col-xs-offset-4 col-xs-4 nonConnect img-responsive" src=".././images/datac_logo.png">
    </div>

    <div class="row">
        <div class="nonConnect" style="text-align: center">
            <h3>Vous ne pouvez pas vous connecter directement sur cette page.</h3>
        </div>
        <!-- Si la taille de l'écran est inférieur à 655px on affiche le deuxième <a> sinon le premier (voir css) -->
        <a id="grand" class="col-xs-offset-4 col-xs-4 btn btn-primary nonConnect" href = "page_connexion.php">Cliquez ici pour vous connecter</a>
        <a id="petit" class="col-xs-offset-4 col-xs-4 btn btn-primary" href = "page_connexion.php">Connexion</a>

    </div>
</div>
<!-- definition de la flèche précédent (retour à accueil) -->
<a class="pagePreced" href="../accueil.php"><img class="logoRetour" src="../images/retour_fleche.png"> </a>
</body>
</html>