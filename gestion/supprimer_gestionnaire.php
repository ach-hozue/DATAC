<!doctype html>
<?php
session_start();
// mise en place d'une sécurité d'accès des pages
// il faut mettre le session_start sinon le empty vérifie que la variable n'exsite pas et
//  sans le session_strart la variable n'exsite pas et donc on est tout le temps dans le if
if (empty($_SESSION['idpers']))
{
    header('Location : page_non_connexion.php');
    exit();
}
else
{
?>
<html>
<head>
    <title>DATÀC – Supprimer une personne</title>
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

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <?php
    $MaRequete = " SELECT * FROM personne where statut = 'gestionnaire'";
    $MonRs = mysqli_query($BDD, $MaRequete);
    $suppr = false;

    // S'il y a bien des personnes à supprimer
    if(mysqli_num_rows($MonRs) != 0)
    {
    ?>
        <!--bannière grise avec choix de la personne-->
        <div class="row rForm">
        <div class="col-sm-10 col-sm-offset-1">
            <form method="post">
                <div class="form-group">
                    <label for="idpers">Personne à supprimer :</label>
                    <select class="form-control" id="idpers" name="idpers">
                        <option selected value = 0>--- Choix de la personne ---</option>
                        <?php
                        while ($tuple = mysqli_fetch_array($MonRs))
                        {
                            ?>
                            <option value = "<?php echo $tuple['id_pers']; ?>"><?php echo $tuple['Prenom']." ".$tuple['Nom']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-danger" type = "submit"  name = "btn_envoi" id = "btn_envoi">Supprimer</button>
                <button class="btn btn-warning" type = "reset">Annuler</button>
            </form>
        </div>
    </div>

        <?php
    }

    // S'il n'y a personne à supprimer
    else
    {
        ?>
    <div class="row rForm rTxt">
        <div class="col-sm-10 col-sm-offset-1">
        <p>Il n’y a pas de suppression possible pour l’instant...</p>
        </div>
    </div>
        <?php
    }
    ?>

    <footer>
        <p>&copy; DATÀC – Tous droits réservés</p>
    </footer>
</div>
</body>
</html>
<?php
if(isset($_POST["btn_envoi"]))
{
    $MaRequete = "delete from `personne` where id_pers = ".$_POST['idpers'];

    if(mysqli_query($BDD, $MaRequete))
    {
        // Message d'alerte
        ?>
        <script>
            alert("<?php echo htmlspecialchars('Votre personne a bien été supprimée.', ENT_QUOTES); ?>");
            window.location.href = 'accueil_gestionnaire.php';
        </script>
        <?php
    }
}
}
?>
