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
    <title>DATÀC – Supprimer un dispositif</title>
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
    // Tableau pour ranger les identifiants des catégories sélectionnées
    $SelectionsBis = array();

    // Rangement de la déficience
    $SelectionsBis[0] = isset($_POST["defBis"])?$_POST["defBis"] :null;

    if(isset($_POST["defBis"]))
    {
        // Détermination du niveau maximal que l’on peut atteindre
        $ReqNivBis = "SELECT MAX(niveau) FROM categorie WHERE id_def_cat = ".$_POST["defBis"];
        $TabNivBis = mysqli_query($BDD, $ReqNivBis);
        $NiveauBis = mysqli_fetch_array($TabNivBis)["MAX(niveau)"];
        $_idDis = isset($_POST["_idDis"])?$_POST["_idDis"]:null;

        // Rangement des catégories
        for($i = 1; $i <= $NiveauBis; $i++)
        {
            $SelectionsBis[$i] = isset($_POST["catBis$i"])?$_POST["catBis$i"] :null;
        }
    }
    ?>

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec choix de la déficience puis de la catégorie et des sous-catégories
        et enfin du dispositif-->
    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <h3>Sélectionnez le dispositif que vous voulez supprimer</h3>
            <form method="post" id="choix">
                <!-- Choix de la déficience -->
                <div class="form-group">
                    <select class="form-control" name = "defBis" id = "niveau0" onChange = "document.forms['choix'].submit();">
                        <option value = "0">--- Choisissez une déficience ---</option>
                        <?php
                        $ReqBis = "SELECT * FROM deficience";
                        $TabBis = mysqli_query($BDD, $ReqBis);

                        // Parcours des déficience
                        while($LecBis = mysqli_fetch_array($TabBis))
                        {
                            // Si on a sélectionné une défience, on la laisse comme valeur par défaut
                            // c’est-à-dire qu’on ajoute dans l’option de la déficience sélectionnée : selected = "selected"
                            ?>
                            <option value = "<?php echo $LecBis["id_deficience"]; ?>"<?php echo((isset($SelectionsBis[0]) && $SelectionsBis[0] == $LecBis["id_deficience"])?' selected = "selected"' :null); ?>><?php echo $LecBis["nom_def"]; ?></option>
                            <?php
                        }

                        mysqli_free_result($TabBis);
                        ?>
                    </select>
                </div>
                <?php
                // Si on a sélectionné une déficience
                if(isset($_POST["defBis"]) && $_POST["defBis"] != 0)
                {
                    ?>
                    <!-- Choix de la catégorie de niveau 1 -->
                    <div class="form-group">
                        <select class="form-control" name = "catBis1" id = "niveau1" onChange = "document.forms['choix'].submit();">
                            <option value = "0">--- Choisissez une catégorie ---</option>
                            <?php
                            $ReqBis = "SELECT * FROM categorie WHERE niveau = 1 AND id_def_cat = ".$SelectionsBis[0];
                            $TabBis = mysqli_query($BDD, $ReqBis);

                            // Affichage des catégories
                            while($LecBis = mysqli_fetch_array($TabBis))
                            {
                                // Si on a sélectionné une catégorie, on la laisse comme valeur par défaut
                                // c’est-à-dire qu’on ajoute dans l’option de la catégorie sélectionnée : selected = "selected"
                                ?>
                                <option value = "<?php echo $LecBis["id_categorie"]; ?>"<?php echo((isset($SelectionsBis[1]) && $SelectionsBis[1] == $LecBis["id_categorie"])?' selected = "selected"' :null); ?>><?php echo $LecBis["nom_cat"]; ?></option>
                                <?php
                            }

                            mysqli_free_result($TabBis);
                            ?>
                        </select>
                    </div>
                    <?php
                    if(isset($_POST["catBis1"]))
                    {
                        // Affichage des dispositifs
                        $RqtDis = "SELECT id_dispositif, nom_dis FROM dispositif WHERE id_cat_dis = $SelectionsBis[1]";
                        $TabDis = mysqli_query($BDD, $RqtDis);

                        // Vérifie s'il renvoie quelque chose
                        if(mysqli_num_rows($TabDis) != 0)
                        {
                            ?>
                            <!-- Choix du dispositif -->
                            <div class="form-group">
                                <select class="form-control" name = "_idDis" id = "_idDis" onchange = "document.forms['choix'].submit();">
                                    <option value = "0">--- Choisissez un dispositif ---</option>
                                    <?php
                                    // Affichage dans une liste déroulante des déficiences
                                    while($LecDis = mysqli_fetch_array($TabDis))
                                    {
                                        ?>
                                        <option value = "<?php echo $LecDis["id_dispositif"]; ?>"<?php echo((isset($_idDis) && $_idDis == $LecDis["id_dispositif"])?' selected = "selected"' :null); ?>><?php echo($LecDis["nom_dis"]); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        }

                        mysqli_free_result($TabDis);
                    }

                    // Cas des sous-catégories (de la deuxième à la dernière)
                    for($i = 2; $i <= $NiveauBis; $i++)
                    {
                        $j = $i - 1;

                        // Si la catégorie précédente a bien été sélectionnée
                        if(isset($_POST["catBis$j"]) && $_POST["catBis$j"] != 0)
                        {
                            $ReqBis = "SELECT * FROM categorie WHERE id_def_cat = ".$SelectionsBis[0]." AND id_cat_prec = ".$SelectionsBis[$j];
                            $TabBis = mysqli_query($BDD, $ReqBis);

                            // Et s’il existe bien une sous-catégorie
                            if(mysqli_num_rows($TabBis) != 0)
                            {
                                ?>
                                <!-- Choix de la catégorie de niveau <?php echo $i; ?> -->
                                <div class="form-group">
                                    <select class="form-control" name = "catBis<?php echo $i; ?>" id = "catBis<?php echo $i; ?>" onChange = "document.forms['choix'].submit();">
                                        <option value = "0">--- Choisissez une catégorie ---</option>
                                        <?php
                                        while($LecBis = mysqli_fetch_array($TabBis))
                                        {
                                            // Si on a sélectionné une catégorie, on la laisse comme valeur par défaut
                                            // c’est-à-dire qu’on ajoute dans l’option de la catégorie sélectionnée : selected = "selected"
                                            ?>
                                            <option value = "<?php echo $LecBis["id_categorie"]; ?>"<?php echo((isset($SelectionsBis[$i]) && $SelectionsBis[$i] == $LecBis["id_categorie"])?' selected = "selected"' :null); ?>><?php echo $LecBis["nom_cat"]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                        }

                        if(isset($_POST["catBis$i"]))
                        {
                            // Affichage des dispositifs
                            $RqtDis = "SELECT id_dispositif, nom_dis FROM dispositif WHERE id_cat_dis = $SelectionsBis[$i]";
                            $TabDis = mysqli_query($BDD, $RqtDis);

                            // Vérifie s'il renvoie quelque chose
                            if(mysqli_num_rows($TabDis) != 0)
                            {
                                ?>
                                <!-- Choix du dispositif -->
                                <div class="form-group">
                                    <select class="form-control" name = "_idDis" id = "_idDis" onchange = "document.forms['choix'].submit();">
                                        <option value = "0">--- Choisissez un dispositif ---</option>
                                        <?php
                                        // Affichage dans une liste déroulante des déficiences
                                        while($LecDis = mysqli_fetch_array($TabDis))
                                        {
                                            ?>
                                            <option value = "<?php echo $LecDis["id_dispositif"]; ?>"<?php echo((isset($_idDis) && $_idDis == $LecDis["id_dispositif"])?' selected = "selected"' :null); ?>><?php echo($LecDis["nom_dis"]); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }

                            mysqli_free_result($TabDis);
                        }
                    }
                }
                ?>
                <button class="btn btn-danger" type="submit" name = "_supprimer">Supprimer</button>
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
if(isset($_POST["_supprimer"]))
{
    if(isset($_POST['_idDis']) && $_POST['_idDis'] != 0)
    {
        $idDispo = $_POST['_idDis'];

        // Suppression du prix du dispositif
        $maRe = "delete from prix where id_dis_prix = $idDispo";
        $monRs = mysqli_query($BDD, $maRe);

        // Suppression du dispositif
        $Suppr = "delete from dispositif where id_dispositif = $idDispo";
        if(mysqli_query($BDD, $Suppr))
        {
            // Message d'alerte
            ?>
            <script>
                alert("<?php echo htmlspecialchars('Le dispositif a bien été supprimé !', ENT_QUOTES); ?>")
                window.location.href = 'accueil_gestionnaire.php';
            </script>
            <?php
        }
    }

    else
    {
        ?>
        <script>alert("Veuillez sélectionner un dispositif !");</script>
        <?php
    }
}
}
?>
