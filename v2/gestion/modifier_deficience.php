<!doctype html>
<?php
session_start();
// mise en place d'une sécurité d'accès des pages
// il faut mettre le session_start sinon le empty vérifie que la variable n'exsite pas et
// sans le session_strart la variable n'exsite pas et donc on est tout le temps dans le if
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
    <title>DATÀC – Modifier une déficience</title>
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

    ?>
    <!--bannière grise avec choix de la déficience-->
    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <h4>Veuillez choisir la déficience que vous voulez modifier :</h4>
            <form method="post" id="choix" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="id_def">Nom de la déficience :</label>
                    <select class="form-control" id="id_def" name="id_def" onChange = "document.forms['choix'].submit();">
                        <option value="0">--- Choix de la déficience ---</option>
                        <?php
                        $marequete = "SELECT * FROM deficience ";
                        $monrs = mysqli_query($BDD, $marequete);

                        //on parcours toutes les déficiences qu'on place dans une liste
                        while ($tuple = mysqli_fetch_array($monrs))
                        {
                            ?>
                            <option value = "<?php echo $tuple['id_deficience']; ?>"<?php echo((isset($_POST["id_def"]) && ($_POST["id_def"]) == $tuple["id_deficience"])?' selected = "selected"' :null); ?>><?php echo $tuple['nom_def']; ?></option>
                            <?php
                        }
                        mysqli_free_result($monrs);
                        ?>
                    </select>
                </div>

                <?php
                if (isset($_POST["id_def"])) {
                    if ($_POST["id_def"] != 0) {
                        ?>

                        <!--bannière grise avec les champs pour modifier la déficience-->

                        <h4>Veuillez compléter les champs que vous souhaitez modifier. Vous n'êtes pas obligé de
                            compléter tous les champs.</h4>
                        <?php
                        // affichage des données actuelles sur le module
                        $marequete = "SELECT * FROM deficience where id_deficience = " . $_POST['id_def'];
                        $MOnrs = mysqli_query($BDD, $marequete);
                        ?>
                        <div class="form-group table-responsive">
                            <table class="table table-bordered tab2">
                                <tr class="nom_colonne">
                                    <th>Nom des colonnes dans la base</th>
                                    <th>Valeurs actuelles</th>
                                    <th>Vos modifications</th>
                                </tr>
                                <?php
                                while ($tuple = mysqli_fetch_array($MOnrs)) {
                                    ?>
                                    <tr>
                                        <td>Nom de la déficience</td>
                                        <td><?php echo $tuple['nom_def']; ?></td>
                                        <td><input class="form-control" type="text" name="nom" id="nom"
                                                   value="<?php echo $tuple['nom_def']; ?>" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Description de la déficience</td>
                                        <td><?php echo $tuple['texte_def']; ?></td>
                                        <td><textarea class="form-control" name="descr" rows="8" cols="275"
                                                      title="descr"
                                                      value="<?php echo $tuple['texte_def']; ?>"><?php echo $tuple['texte_def']; ?></textarea>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                        <p class="validation">
                            <input type="hidden" name="def" value= <?php echo $_POST['id_def']; ?>/>
                            <button class="btn btn-primary" type="submit" name="btn_envoi2" id="btn_envoi2">Modifier
                            </button>
                            <button class="btn btn-warning" type="reset">Annuler</button>
                        </p>
                        <?php
                    }
                }
                ?>
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
$modif = false;

if(isset($_POST["btn_envoi2"]))
{
    $mareq= "UPDATE `deficience` SET `nom_def` = '".$_POST['nom']."', `texte_def` = '".$_POST['descr']."' WHERE id_deficience = ".$_POST['def'];

    if(mysqli_query($BDD, $mareq))
    {
        // Message d'alerte
        ?>
        <script>
            alert("<?php echo htmlspecialchars('Votre modification a bien été prise en compte.', ENT_QUOTES); ?>");
            window.location.href='accueil_gestionnaire.php';
        </script>
        <?php
    }
}
}
?>