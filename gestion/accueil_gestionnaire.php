<!doctype html>
<?php
session_start();
// mise en place d'une sécurité d'accès des pages
// il faut mettre le session_start sinon le empty vérifie que la variable n'exsite pas et
//  sans le session_start la variable n'exsite pas et donc on est tout le temps dans le if
if (empty($_SESSION['idpers']))
{
    header('Location: page_non_connexion.php');
    exit();
}
else
{
?>
<html>
<head>
    <title>DATÀC – Gestion du site</title>
    <meta charset = "utf-8" />
    <link rel = "stylesheet" href = ".././bootstrap/css/bootstrap.css"/>
    <link rel = "stylesheet" href = ".././bootstrap/css/bootstrap-theme.css"/>
    <link rel = "stylesheet" href = "msf_interne.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
<!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
<div class="container-fluid">

    <div class="row">
        <!--headerGestion = bannière blanche avec logos, retour au site, deconnexion et connecter en tant que...-->
        <?php include("headerGestion.php");?>
    </div>

    <!--menu sur bannière bleu-->
    <div class="row rMenu">
        <div class="col-sm-offset-1 col-sm-10">
        <?php
        include("menu.php");
        ?>
        </div>
    </div>
    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise-->
    <div class="row rTxt">
        Bienvenue sur la gestion du site DATÀC
        <br><br>
        Ici vous pouvez faire des ajouts, des suppressions, des modifications, des duplications et modifier votre compte.
    </div>

        <footer>
            <p>&copy; DATÀC – Tous droits réservés</p>
        </footer>
</div>
</body>
</html>
<?php
}
?>