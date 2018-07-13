<!doctype html>
<?php
session_start();
// mise en place d'une sécurité d'accès des pages
// il faut mettre le session_start sinon le empty vérifie que la variable n'exsite pas et
// sans le session_strart la variable n'exsite pas et donc on est tout le temps dans le if
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
    <title>DATÀC – Modifier son compte</title>
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
        <?php
        include("headerGestion.php");
        ?>
    </div>

    <!--menu sur bannière bleu-->
    <div class="row rMenu">
        <div class="col-sm-offset-1 col-sm-10">
            <?php
            include("menu.php");
            ?>
        </div>
    </div>
    <?php

    //Selection de la personne qui veut modifier son compte
    $RqtInfo = "SELECT * FROM personne WHERE id_pers = ".$_SESSION['idpers'];
    $TabInfo = mysqli_query($BDD, $RqtInfo);
    $LecInfo = mysqli_fetch_array($TabInfo);
    ?>

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec formulaire de modifications de compte-->
    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <p class = "consigne">
                Vous souhaitez modifier les renseignements sur votre compte.
                Vous pouvez remplir autant de lignes dans le formulaire ci-dessous que vous souhaitez en changer.
            </p>
            <form method = "POST">
                <div class="form-group">
                    <label for="login">Login :</label>
                    <input class="form-control" type="text" name = "login" id = "login" value="<?php echo $LecInfo["login"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe :</label>
                    <input class="form-control" type="password" name = "mdp" id = "mdp" value="<?php echo $LecInfo["mdp"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Login :</label>
                    <input class="form-control" name = "email" id = "email" value="<?php echo $LecInfo["mail"]; ?>" required>
                </div>
                <button class="btn btn-primary ok" type="submit" name = "btn_envoi" id = "btn_envoi">EXECUTER</button>
                <button class="btn btn-warning stop" type="reset">ANNULER</button>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; DATÀC – Tous droits réservés</p>
    </footer>
</div>
</body>
</html>

<?php
if(isset($_POST["btn_envoi"]))
{
    //modification du compte
    $marequete = "UPDATE `personne` SET login = '".$_POST['login']."', mdp = '".$_POST['mdp']."', mail = '".$_POST['email']."' where id_pers = ".$_SESSION['idpers'];

    if (mysqli_query ($BDD, $marequete))
    {
        ?>
        <script>alert("Les paramètres de votre compte ont bien été modifiés");</script>
        <?php
    }
}
}
?>