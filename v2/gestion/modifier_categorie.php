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
    <title>DATÀC – Modifier une catégorie</title>
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

    <!--bannière grise avec choix de la déficience-->
    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <form method="post" id="choix" enctype="multipart/form-data">
                <h4>Veuillez choisir la déficience qui contient la catégorie que vous voulez modifier :</h4>
                <div class="form-group">
                    <label for="def">Nom de la déficience :</label>
                    <select class="form-control" id="def" name="def" onChange = "document.forms['choix'].submit();">
                        <option value="0">--- Choix de la déficience ---</option>
                        <?php
                        $marequete = "SELECT * FROM deficience ";
                        $monrs = mysqli_query($BDD, $marequete);

                        //on parcours toutes les déficiences qu'on place dans une liste
                        while ($tuple = mysqli_fetch_array($monrs))
                        {
                            ?>
                            <option value = "<?php echo $tuple['id_deficience']; ?>"<?php echo((isset($_POST["def"]) && ($_POST["def"]) == $tuple["id_deficience"])?' selected = "selected"' :null); ?>><?php echo $tuple['nom_def']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
                $niveau = 0;
                $selectBis = [];
                if(isset($_POST["def"])) {
                    if ($_POST["def"] != 0) {

// Tableau pour ranger les identifiants des catégories sélectionnées
                        $SelectionsBis = array();

                        // Rangement de la déficience
                        $SelectionsBis[0] = isset($_POST["def"])?$_POST["def"] :null;

// Détermination du niveau maximal que l’on peut atteindre
                        $ReqNivBis = "SELECT MAX(niveau) FROM categorie WHERE id_def_cat = " . $_POST["def"];
                        $TabNivBis = mysqli_query($BDD, $ReqNivBis);
                        $NiveauBis = mysqli_fetch_array($TabNivBis)["MAX(niveau)"];
                        $niveau = $NiveauBis;

// Rangement des catégories
                        for ($i = 1; $i <= $NiveauBis; $i++) {
                            $SelectionsBis[$i] = isset($_POST["idcat$i"]) ? $_POST["idcat$i"] : null;
                        }
                        $selectBis = $SelectionsBis;
                        ?>
                        <!--bannière grise avec choix de la catégorie-->
                        <h4>Veuillez choisir la catégorie que vous voulez modifier :</h4>
                        <div class="form-group">
                            <label for="idcat">Nom de la catégorie :</label>
                            <select class="form-control" name="idcat1" id="niveau1"
                                    onChange="document.forms['choix'].submit();">
                                <option value=0>--- Choix de la catégorie ---</option>
                                <?php
                                $marequete = "SELECT * FROM categorie where niveau = 1 AND id_def_cat = " . $_POST['def'];
                                $monrs = mysqli_query($BDD, $marequete);
                                //on parcours toutes les catégories d'une déficience qu'on place dans une liste
                                while ($tuple = mysqli_fetch_array($monrs)) {
                                    ?>
                                    <option value="<?php echo $tuple['id_categorie']; ?>"<?php echo((isset($_POST["idcat1"]) && $_POST["idcat1"] == $tuple["id_categorie"])?' selected = "selected"' :null); ?>><?php echo $tuple['nom_cat']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php

                    }
                }
                $j = 0;
                if(isset($_POST["def"])) {
                    if ($_POST["def"] != 0) {
                        echo "post def";
                        // Cas des sous-catégories (de la deuxième à la dernière)
                        for ($i = 2; $i <= $niveau; $i++) {
                            $j = $i - 1;

                            // Si la catégorie précédente a bien été sélectionnée
                            if (isset($_POST["idcat$j"])){
                                if($_POST["idcat$j"] != 0){
                                    $ReqBis = "SELECT * FROM categorie WHERE id_def_cat = " . $_POST['def'] . " AND id_cat_prec = " . $selectBis[$j];
                                    $TabBis = mysqli_query($BDD, $ReqBis);

                                    // Et s’il existe bien une sous-catégorie
                                    if (mysqli_num_rows($TabBis) != 0) {
                                        ?>
                                        <!-- Choix de la catégorie de niveau <?php echo $i; ?> -->
                                        <div class="form-group">
                                            <select class="form-control" name="idcat<?php echo $i; ?>"
                                                    id="niveau<?php echo $i; ?>"
                                                    onChange="document.forms['choix'].submit();">
                                                <option value="0">--- Choisissez une catégorie ---</option>
                                                <?php
                                                while ($LecBis = mysqli_fetch_array($TabBis)) {
                                                    // Si on a sélectionné une catégorie, on la laisse comme valeur par défaut
                                                    // c’est-à-dire qu’on ajoute dans l’option de la catégorie sélectionnée : selected = "selected"
                                                    ?>
                                                    <option value="<?php echo $LecBis["id_categorie"]; ?>"<?php echo((isset($selectBis[$i]) && $selectBis[$i] == $LecBis["id_categorie"]) ? ' selected = "selected"' : null); ?>><?php echo $LecBis['nom_cat']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>

                        <!--<a class="btn btn-primary" id = "choixCategorie" href="modifier_categorie.php?choisi=1">Choisir cette catégorie</a>-->

                        <?php

                        echo "post cat";
                        ?>
                        <!--bannière grise avec les champs pour modifier la catégorie-->

                        <h4>Veuillez compléter les champs que vous souhaitez modifier. Vous n'êtes pas obligé de compléter tous les champs.</h4>
                        <?php
                        //récupération et affichage des champs pouvant être modifiés
                        $marequete = "SELECT * FROM categorie where id_categorie = ".$_POST['idcat'.$j];
                        $MOnrs = mysqli_query($BDD, $marequete);
                        $tuple = mysqli_fetch_array($MOnrs);
                        ?>
                        <div class="form-group table-responsive">
                            <table class = "table table-bordered tab2">
                                <tr class = "nom_colonne">
                                    <td>Nom des colonnes dans la base</td>
                                    <td>Valeurs actuelles</td>
                                    <td>Vos modifications</td>
                                </tr>
                                <tr>
                                    <td>Nom de la catégorie</td>
                                    <td><?php echo $tuple['nom_cat']; ?></td>
                                    <td><input class="form-control" type = "text" name = "nom" id = "nom" value = "<?php echo $tuple['nom_cat']; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td>Description de la catégorie</td>
                                    <td><?php echo $tuple['texte_cat']; ?></td>
                                    <td> <textarea class="form-control" name = "descr" rows = "8" cols="55" title="descr" value = "<?php echo $tuple['texte_cat']; ?>"><?php echo $tuple['texte_cat']; ?></textarea></td>
                                </tr>
                            </table>
                        </div>
                        <p class = "validation" >
                            <button class="btn btn-primary" type = "submit" name = "modifier" id = "btn_envoi">Modifier</button>
                            <button class="btn btn-warning" type = "reset">Annuler</button>
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

if(isset($_POST["modifier"]))
{
    $mareq= "UPDATE `categorie` SET `nom_cat` = '".$_POST['nom']."', `texte_cat` = '".$_POST['descr']."' WHERE id_categorie = ".$_POST['idcat'];
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