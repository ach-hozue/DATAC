<!doctype html>
<?php
session_start();
// mise en place d'une sécurité d'accès des pages
// il faut mettre le session_start sinon le empty vérifie que la variable n'exsite pas et
//  sans le session_strart la variable n'exsite pas et donc on est tout le temps dans le if
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
    <title>DATÀC – Ajouter une personne</title>
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

    <!--headerGestion = bannière blanche avec logos, retour au site, deconnexion et connecter en tant que...-->
    <div class="row">
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

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec formulaire d'ajout-->
    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <form method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input class="form-control" type = "text" id = "nom" name = "nom" size = "40" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prenom</label>
                    <input class="form-control" type = "text" id = "prenom" name = "prenom" size = "40" required>
                </div>

                <div class="form-group">
                    <label for="login">Login</label>
                    <input class="form-control" type = "text" id = "login" name = "login" size = "40" required>
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input class="form-control" type = "text" id = "mdp" name = "mdp" size = "40" required>
                </div>

                <div class="form-group">
                    <label for="mail">Adresse mail</label>
                    <input class="form-control" type = "text" id = "mail" name = "mail" size = "40" required>
                </div>

                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select class="form-control" id = "statut" name = "statut">
                        <option value = "administrateur">administrateur</option>
                        <option value = "gestionnaire">gestionnaire (ne peut pas ajouter ni supprimer des personnes)</option>
                    </select>
                </div>

                <button class="btn btn-primary" type = "submit" name = "btn_envoi" id = "btn_envoi">Ajouter</button>
                <button class="btn btn-warning" type = "reset">Annuler</button>
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
    $MaRequete = "INSERT INTO `personne`(`id_pers`, `login`, `mdp`, `mail`, `statut`, `Nom` , `Prenom`) VALUES (null,'".$_POST['login']."','".$_POST['mdp']."', '".$_POST['mail']."' , '".$_POST['statut']."' ,'".$_POST['nom']."' , '".$_POST['prenom']."')";

    if(mysqli_query($BDD, $MaRequete))
    {
        // Message d'alerte
        ?>
        <script>
            alert("<?php echo htmlspecialchars('Votre personne a bien été insérée dans la base.', ENT_QUOTES); ?>")
            window.location.href = 'accueil_gestionnaire.php';
        </script>
        <?php
    }
}
}
?>