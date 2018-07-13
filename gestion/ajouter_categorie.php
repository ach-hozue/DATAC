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
    <title>DATÀC – Ajouter une catégorie</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href=".././bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href=".././bootstrap/css/bootstrap-theme.css"/>
    <link rel="stylesheet" href="msf_interne.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
<div class="container-fluid">

    <div class="row">
        <?php
        include("headerGestion.php");
        ?>
    </div>

    <div class="row rMenu">
        <div class="col-sm-offset-1 col-sm-10">
            <?php
            include("menu.php");
            ?>
        </div>
    </div>

    <?php

    // Tableau pour ranger les identifiants des catégories sélectionnées
    $Selections = array();

    // Rangement de la déficience
    $Selections[0] = isset($_POST["def"]) ? $_POST["def"] : null;

    if (isset($_POST["def"])) {
        // Détermination du niveau maximal que l’on peut atteindre
        $ReqNiv = "SELECT MAX(niveau) FROM categorie WHERE id_def_cat = " . $_POST["def"];
        $TabNiv = mysqli_query($BDD, $ReqNiv);
        $Niveau = mysqli_fetch_array($TabNiv)["MAX(niveau)"];

        // Rangement des catégories
        for ($i = 1; $i <= $Niveau; $i++) {
            $Selections[$i] = isset($_POST["cat$i"]) ? $_POST["cat$i"] : null;
        }

        // Récupération de la dernière catégorie sélectionnée (là ou on veut ajouter la catégorie)
        // Recherche du dernier élément du tableau non nul
        $position = 0;
        $pasTrouve = TRUE;
        while ($pasTrouve) {
            if (!isset($Selections[$position]) || $Selections[$position] == 0) {
                $pasTrouve = FALSE;
            } else {
                $position = $position + 1;
            }
        }

        $_idCat = $Selections[$position - 1];
        $_type = $position - 1;
    }
    ?>

    <div class="row penche"></div>
    <div class="row pencheSect"></div>

    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <form method="post" id="choix">
                <div class="form-group">
                    <label for="niveau0">Sélectionnez une déficience :</label>
                    <select class="form-control" name="def" id="niveau0" onChange="document.forms['choix'].submit();">
                        <option value="0">--- Choisissez une déficience ---</option>
                        <?php
                        $Req = "SELECT * FROM deficience";
                        mysqli_set_charset($BDD, "utf8");
                        $Tab = mysqli_query($BDD, $Req);

                        // Parcours des déficience
                        while ($Lec = mysqli_fetch_array($Tab)) {
                            // Si on a sélectionné une défience, on la laisse comme valeur par défaut
                            // c’est-à-dire qu’on ajoute dans l’option de la déficience sélectionnée : selected = "selected"
                            ?>
                            <option value="<?php echo $Lec["id_deficience"]; ?>"<?php echo((isset($Selections[0]) && $Selections[0] == $Lec["id_deficience"]) ? ' selected = "selected"' : null); ?>><?php echo $Lec["nom_def"]; ?></option>
                            <?php
                        }

                        mysqli_free_result($Tab);
                        ?>
                    </select>
                </div>

                <?php
                // Si on a sélectionné une déficience
                if (isset($_POST["def"]) && $_POST["def"] != 0) {
                    ?>
                    <div class="form-group">
                        <label for="niveau1">Choisissez la première catégorie dans laquelle vous souhaitez ajouter une
                            sous-catégorie (facultatif) :</label>
                        <select class="form-control" name="cat1" id="niveau1"
                                onChange="document.forms['choix'].submit();">
                            <option value="0">--- Aucune catégorie choisie ---</option>
                            <?php
                            $Req = "SELECT * FROM categorie WHERE niveau = 1 AND id_def_cat = " . $Selections[0];
                            $Tab = mysqli_query($BDD, $Req);

                            // Affichage des catégories
                            while ($Lec = mysqli_fetch_array($Tab)) {
                                // Si on a sélectionné une catégorie, on la laisse comme valeur par défaut
                                // c’est-à-dire qu’on ajoute dans l’option de la catégorie sélectionnée : selected = "selected"
                                ?>
                                <option value="<?php echo $Lec["id_categorie"]; ?>"<?php echo((isset($Selections[1]) && $Selections[1] == $Lec["id_categorie"]) ? ' selected = "selected"' : null); ?>><?php echo $Lec["nom_cat"]; ?></option>
                                <?php
                            }

                            mysqli_free_result($Tab);
                            ?>
                        </select>
                    </div>
                    <?php
                    // Cas des sous-catégories (de la deuxième à la dernière)
                    for ($i = 2; $i <= $Niveau; $i++) {
                        $j = $i - 1;

                        // Si la catégorie précédente a bien été sélectionnée
                        if (isset($_POST["cat$j"]) && $_POST["cat$j"] != 0) {
                            $Req = "SELECT * FROM categorie WHERE id_def_cat = " . $Selections[0] . " AND id_cat_prec = " . $Selections[$j];
                            $Tab = mysqli_query($BDD, $Req);

                            // Et s’il existe bien une sous-catégorie
                            if (mysqli_num_rows($Tab) != 0) {
                                ?>

                                <div class="form-group">
                                    <label for="sel<?php echo $i; ?>">Choisissez la sous-catégorie dans laquelle vous
                                        souhaitez ajouter une autre sous-catégorie (facultatif) : </label>
                                    <select class="form-control" name="cat<?php echo $i; ?>" id="cat<?php echo $i; ?>"
                                            onChange="document.forms['choix'].submit();">
                                        <option value="0">--- Aucune catégorie choisie ---</option>
                                        <?php
                                        while ($Lec = mysqli_fetch_array($Tab)) {
                                            // Si on a sélectionné une catégorie, on la laisse comme valeur par défaut
                                            // c’est-à-dire qu’on ajoute dans l’option de la catégorie sélectionnée : selected = "selected"
                                            ?>
                                            <option value="<?php echo $Lec["id_categorie"]; ?>"<?php echo((isset($Selections[$i]) && $Selections[$i] == $Lec["id_categorie"]) ? ' selected = "selected"' : null); ?>><?php echo $Lec["nom_cat"]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <?php
                            }
                            mysqli_free_result($Tab);
                        }
                    }
                }
                ?>

                <div class="form-group">
                    <label for="name">Écrivez le nom de la catégorie que vous souhaitez ajouter :</label>
                    <input type="text" class="form-control" id="name" name="_nom">
                </div>
                <div class="form-group">
                    <label for="description">Description de la catégorie :</label>
                    <textarea class="form-control" rows=8 id="description" name="_description"></textarea>
                </div>
                <button class="btn btn-primary" type="submit" name="_ajouter">Ajouter</button>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; DATÀC – Tous droits réservés</p>
    </footer>
</div>

<?php
if (isset($_POST["_ajouter"]) && isset($_POST["_nom"])) {
    $nomCat = $_POST["_nom"];
    $description = $_POST["_description"];
    $idCat = isset($_idCat) ? $_idCat : 0;
    $type = isset($_type) ? $_type : 0;
    $ajout = FALSE;

    // Vérification de l'existence de la catégorie
    $RqtIdCat = "SELECT id_categorie FROM categorie WHERE nom_cat = '$nomCat'";
    $TabIdCat = mysqli_query($BDD, $RqtIdCat);
    $nbCat = mysqli_num_rows($TabIdCat);

if ($nbCat > 1)
{
    ?>
    <script> alert("Cette catégorie existe déjà !"); </script>
<?php
}

else
{
if ($type != 0 && $idCat != 0)
{
    $RqtCatPrec = "SELECT * FROM categorie WHERE id_categorie = $idCat";
    $TabCatPrec = mysqli_query($BDD, $RqtCatPrec);
    $TupleCatPrec = mysqli_fetch_array($TabCatPrec);

    // Ajout de la catégorie
    $RqtCat = "INSERT INTO categorie (nom_cat, texte_cat, niveau, id_def_cat, id_cat_prec) VALUES ('$nomCat','$description', '" . ($TupleCatPrec["niveau"] + 1) . "','" . $TupleCatPrec["id_def_cat"] . "','" . $TupleCatPrec["id_categorie"] . "')";
    if (mysqli_query($BDD, $RqtCat)) {
        $ajout = TRUE;
    }
}

else if ($type == 0 && $idCat != 0)
{
    $RqtDefPrec = "SELECT * FROM deficience WHERE id_deficience = $idCat";
    $TabDefPrec = mysqli_query($BDD, $RqtDefPrec);
    $TupleDefPrec = mysqli_fetch_array($TabDefPrec);

    // Ajout de la catégorie
    $RqtCat = "INSERT INTO categorie (nom_cat, texte_cat, niveau, id_def_cat) VALUES ('$nomCat','$description', '1','" . $TupleDefPrec["id_deficience"] . "')";
    if (mysqli_query($BDD, $RqtCat)) {
        $ajout = TRUE;
    }
}

else
{
?>
    <script> alert("Veuillez sélectionner une catégorie ou une déficience !"); </script>
<?php
}
}

if ($ajout)
{
// Message d'alerte
?>
    <script>
        alert("<?php echo htmlspecialchars('Votre catégorie a bien été ajoutée', ENT_QUOTES); ?>");
        window.location.href = 'accueil_gestionnaire.php';
    </script>
    <?php
}

}
}
?>
</body>
</html>
