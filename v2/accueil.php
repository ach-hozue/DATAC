<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DATÀC – Accueil</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link id="css" rel="stylesheet" href="mise_en_forme.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/npm.js"></script>
    <!--import pour le modal("i")-->
    <link href="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.css" rel="stylesheet">
    <script src="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.js"></script>

</head>
<body>
<!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
<div class="container-fluid">

    <!--header = bannière blanche avec logos, connexion et recherche + titre sur fond bleu-->
    <?php include("header.php"); ?>

    <!--suite bannière bleu (après titre)-->
    <div class="row" id="r3">
        <h3>Bienvenue</h3>
        <p class="col-sm-offset-1 col-sm-10">
            Ce site présente un catalogue exhaustif des dispositifs et aides techniques à la communication,
            destiné à toutes personnes en situation de handicap, leurs proches ainsi que les professionnels de santé.
        </p>
    </div>

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec boutons deficiences + modals d'informations-->
    <section class="row" id="rSect">

        <article>

            <?php
            // Connexion à la base de données
            require("connect.php");
            mysqli_set_charset($BDD, "utf8");
            // Recherche et affichage (hyperlien) de toutes les déficiences
            $RqtDef = "SELECT * FROM deficience";
            $TabDef = mysqli_query($BDD, $RqtDef);

            while ($LgnDef = mysqli_fetch_array($TabDef)) {
                ?>

                <!--boutons deficiences-->
                <div class="col-sm-offset-5">
                    <!--definition d'un modal -->
                    <div style="display:none">
                        <div id="<?php echo $LgnDef["id_deficience"]; ?>" class="modal-container">
                            <div  class="modal-title"><?php echo $LgnDef["nom_def"]; ?></div>
                            <div class="modal-body">
                                <?php
                                if ($LgnDef["texte_def"] != NULL OR $LgnDef["texte_def"] != "") {
                                    ?>
                                    <p class="descrp"><?php echo $LgnDef["texte_def"]; ?></p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--bouton "i"-->
                    <a href="<?php echo '#'.$LgnDef["id_deficience"].''; ?>" class="glyphicon glyphicon-info-sign <?php echo 'modal'.$LgnDef["id_deficience"].''; ?>" name="<?php echo $LgnDef["nom_def"]; ?>"></a>

                    <!--definition du bouton-->
                    <a class="btn btn-primary btnparcours" href="deficience.php?idDef=<?php echo $LgnDef["id_deficience"]; ?> "><?php echo $LgnDef["nom_def"]; ?></a>

                    <!-- definition de la boite modal -->
                    <script type="text/javascript">
                        $("<?php echo '.modal'.$LgnDef["id_deficience"].''; ?>").fancybox({
                            maxWidth    : 800,
                            maxHeight    : 600,
                            fitToView    : false,
                            width        : '70%',
                            height        : '70%',
                            autoSize    : false,
                            closeClick    : false,
                            openEffect    : 'none',
                            closeEffect    : 'none'
                        });
                    </script>
                </div>

                <br/>
                <?php
            }
            //libère la ressource TabDef
            mysqli_free_result($TabDef);
            //ferme la base de donnée
            mysqli_close($BDD);
            ?>
        </article>
    </section>
    <div class="row">
        <?php include("bas.php"); ?>
    </div>
</div>
</body>
</html>
