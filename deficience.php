<!DOCTYPE html>
<?php
// Connexion à la base de données
require("connect.php");
mysqli_set_charset($BDD, "utf8");

// Recherche de l’indentifiant et du nom de la déficience sur laquelle on vient de cliquer
$idDef = $_GET["idDef"];
$RqtDef = "SELECT * FROM deficience WHERE id_deficience = $idDef";
$TabDef = mysqli_query($BDD, $RqtDef);
$LgnDef = mysqli_fetch_array($TabDef);
$nomDef = $LgnDef["nom_def"];
mysqli_free_result($TabDef);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>DATÀC – <?php print $nomDef; ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link id="css" rel="stylesheet" href="mise_en_forme.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <!--import pour le modal("i")-->
    <link href="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.css" rel="stylesheet">
    <script src="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.js"></script>

</head>
<body>
<!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
<div class="container-fluid">

    <!--header = bannière blance avec logos, connexion et recherche + titre sur fond bleu-->
    <?php include("header.php"); ?>

    <!--suite bannière bleu (après titre)-->
    <div class="row" id="rArianne">
        <!--Fil d’Ariane-->
        <br><p class="ariane col-sm-offset-1">
            <a class="ariane" href="accueil.php">Accueil</a>
            // <?php echo $nomDef; ?>
        </p>
    </div>

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec boutons catégories + modal(s) d'information(s)-->
    <section class="row" id="rSect">

        <article>
            <br><p class="col-sm-offset-1 col-sm-10 sousTitre">Pour cette déficience, il y a les catégories de dispositifs suivantes :</p><br><br><br><br>
            <?php
            // Recupération des catégories à afficher
            $RqtCat = "SELECT * FROM categorie WHERE id_def_cat = $idDef AND niveau = 1";
            $TabCat = mysqli_query($BDD, $RqtCat);

            while ($LgnCat = mysqli_fetch_array($TabCat)) {

                // Affichage d'une description (modal) en plus du bouton s'il y en a une
                if ($LgnCat["texte_cat"] != NULL OR $LgnCat["texte_cat"] != "") {
                    ?>
                    <div class="col-sm-offset-5">
                        <!--definition d'un modal -->
                        <div style="display:none">
                            <div id="modalD" class="modal-container">
                                <div class="modal-title"><?php echo $LgnCat["nom_cat"]; ?></div>
                                <div class="modal-body">
                                    <p class="descrp"><?php echo $LgnCat["texte_cat"]; ?></p>
                                </div>
                            </div>
                        </div>
                        <!--bouton "i" -->
                        <a href="#modalD"  class="glyphicon glyphicon-info-sign modalDef" name="<?php echo $LgnCat["nom_cat"]; ?>"></a>

                        <!-- definition de la boite modal -->
                        <script type="text/javascript">
                            $(".modalDef").fancybox({
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

                        <!--definition du bouton-->
                        <a class="btn btn-primary btnparcours" href="categorie.php?idCat=<?php echo $LgnCat["id_categorie"]; ?>&niv=1"><?php echo $LgnCat["nom_cat"]; ?></a>
                    </div>
                    <br>
                    <?php
                } else {
                    ?>
                    <!-- affichage d'un bouton + d'un icone de modal mais invisible (par soucis d'alignement avec les autres boutons) -->
                    <div class="col-sm-offset-5">
                        <!-- icon de modal invisible -->
                        <a class="glyphicon glyphicon-info-sign" style="color: transparent" name="<?php echo $LgnCat["nom_cat"]; ?>" ></a>
                        <!-- definition du bouton -->
                        <a class="btn btn-primary btnparcours" href="categorie.php?idCat=<?php echo $LgnCat["id_categorie"]; ?>&niv=1"><?php echo $LgnCat["nom_cat"]; ?></a>
                    </div>
                    <br>
                    <?php
                }
                ?>

                <?php
            }

            //libère la ressource TabDef
            mysqli_free_result($TabCat);
            //ferme la base de donnée
            mysqli_close($BDD);
            ?>

        </article>
    </section>
    <div class="row" id="rFooter">

        <?php include("bas.php"); ?>
    </div>
</div>
<!-- definition de la flèche précédent (retour à accueil) -->
<a class="pagePreced" href="accueil.php"><img class="logoRetour" src="images/retour_fleche.png"> </a>
</body>
</html>