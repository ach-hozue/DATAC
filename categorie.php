<!DOCTYPE html>
<?php
// Connexion à la base de données
require("connect.php");
mysqli_set_charset($BDD, "utf8");

// Récupération du niveau et du nom de la catégorie sur laquelle on vient de cliquer
$niv =  htmlentities($_GET["niv"]);
$idCat =  htmlentities($_GET["idCat"]);

<<<<<<< HEAD
$bool=false;

=======
>>>>>>> b53d3d67c64b4d5a9744dde331490ffac0cba918
// Recherche de l’indentifiant et du nom de la catégorie sur laquelle on vient de cliquer et la déficience à laquelle elle appartient
$RqtRecup = "SELECT * FROM deficience, categorie WHERE id_deficience = id_def_cat AND id_categorie = $idCat";
$TabRecup = mysqli_query($BDD, $RqtRecup);
$LgnRecup = mysqli_fetch_array($TabRecup);
$nomDef = mysqli_fetch_array($TabRecup);
mysqli_free_result($TabRecup);

// Assignation à des variables
$idDef = $LgnRecup["id_deficience"];
$idCatPrec = $LgnRecup["id_cat_prec"];
$nomDef = $LgnRecup["nom_def"];
$nomCat = $LgnRecup["nom_cat"];

// Utilisation d’un tableau pour recenser les noms des catégories précédentes
$tabCat[0] = $nomDef;
$tabCat[$niv] = $nomCat;

// Utilisation d’un tableau pour recenser les identifiants des catégories précédentes
$tabCatId[0] = $idDef;
$tabCatId[$niv] = $idCat;

// Assignation dans les tableaux des noms et identifiants de chaque catégorie
for ($i = 1; $i < $niv; $i++) {
    $RqtCatPrec = "SELECT * FROM categorie WHERE id_categorie = $idCatPrec";
    $TabCatPrec = mysqli_query($BDD, $RqtCatPrec);
    if (mysqli_num_rows($TabCatPrec) != 0) {
        $LgnCatPrec = mysqli_fetch_array($TabCatPrec);
        $tabCat[$niv - $i] = $LgnCatPrec["nom_cat"];
        $tabCatId[$niv - $i] = $idCatPrec;
        $idCatPrec = $LgnCatPrec["id_cat_prec"];
    }
    mysqli_free_result($TabCatPrec);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>DATÀC – <?php echo $nomCat; ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link id="css" rel="stylesheet" href="mise_en_forme.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script href="bootstrap/js/bootstrap.js"></script>
    <script href="bootstrap/js/npm.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
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
        <p class="ariane col-sm-offset-1">
            <a class="ariane" href="accueil.php">Accueil</a>
            // <a class="fAriane" href="deficience.php?idDef=<?php echo $tabCatId[0]; ?>"><?php echo $tabCat[0]; ?></a>
            <?php
            // Pour les sous-catégories
            for ($i = 1; $i <= $niv; $i++) {
                ?>
<<<<<<< HEAD
                // <a class="fAriane"
=======
                > <a class="fAriane"
>>>>>>> b53d3d67c64b4d5a9744dde331490ffac0cba918
                    href="categorie.php?idCat=<?php echo $tabCatId[$i]; ?>&niv=<?php echo $i; ?>"><?php echo $tabCat[$i]; ?></a>
                <?php
            }
            ?>
        </p>
    </div>
    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>
    <!--bannière grise avec boutons catégories + modal(s) d'information(s)-->
    <section class="row" id="rSect">
        <?php
        // On regarde s’il existe des sous-catégories à la catégorie sur laquelle on vient de cliquer
        $RqtFin = "SELECT * FROM categorie WHERE id_cat_prec = $idCat";
        $TabFin = mysqli_query($BDD, $RqtFin);
        // Et s’il existe des dispositifs dans la catégorie sur laquelle on vient de cliquer
        $RqtFnl = "SELECT * FROM dispositif WHERE id_cat_dis = $idCat";
        $TabFnl = mysqli_query($BDD, $RqtFnl);
        // Si il y a des dispositifs on génère la page d’affichage de la liste de ces dispositifs
        if (mysqli_num_rows($TabFnl) != 0 || mysqli_num_rows($TabFin) == 0) {
            ?>
            <article>
                <p class="col-sm-offset-1 col-sm-10 sousTitre">Il existe les produits suivants :</p>
                <?php
                // Recherche et affichage de tous les dispositifs relatifs à la catégorie choisie
                $RqtDis = "SELECT * FROM dispositif WHERE id_cat_dis = $idCat";
                $TabDis = mysqli_query($BDD, $RqtDis);
                while ($LgnDis = mysqli_fetch_array($TabDis)) {
                    ?>
                    <!--boutons des dispositifs-->
                    <div class="col-sm-offset-5">
<<<<<<< HEAD
                        <a class="btn btn-primary btnparcours" href="dispositif.php?bool=<?php echo $bool ?>&idDis=<?php echo $LgnDis["id_dispositif"]; ?>"><?php echo $LgnDis["nom_dis"]; ?></a>
=======
                        <a class="btn btn-primary btnparcours" href="dispositif.php?idDis=<?php echo $LgnDis["id_dispositif"]; ?>"><?php echo $LgnDis["nom_dis"]; ?></a>
>>>>>>> b53d3d67c64b4d5a9744dde331490ffac0cba918
                    </div>
                    <br>
                    <?php
                }
                ?>
            </article>
            <?php
            mysqli_free_result($TabDis);
        }
        // S’il n’y a pas de dispositifs, on génère la page d’affichage de la liste des sous-catégories
        if (mysqli_num_rows($TabFin) != 0) {
            ?>
            <article>
                <p class="col-sm-offset-1 col-sm-10 sousTitre">Il existe les catégories suivantes :</p>
                <br>
                <br>
                <br>
                <?php
                // Recherche et affichage des toutes les sous-catégories relatives à la catégorie choisie
                $RqtCatSuiv = "SELECT * FROM categorie WHERE id_cat_prec = $idCat AND niveau = ($niv+1)";
                $TabCatSuiv = mysqli_query($BDD, $RqtCatSuiv);
                while ($LgnCatSuiv = mysqli_fetch_array($TabCatSuiv)) {
                    ?>
                    <?php
                    // Affichage d'une description (modal) en plus du bouton s'il y en a une
                    if ($LgnCatSuiv["texte_cat"] != NULL OR $LgnCatSuiv["texte_cat"] != "") {
                        ?>
                        <div class="col-sm-offset-5">
                            <!--definition d'un modal -->
                            <div style="display:none">
                                <div id="<?php echo $LgnCatSuiv["id_categorie"]; ?>" class="modal-container">
                                    <div class="modal-title"><?php echo $LgnCatSuiv["nom_cat"]; ?></div>
                                    <div class="modal-body">
                                        <p class="descrp"><?php echo $LgnCatSuiv["texte_cat"]; ?></p>
                                    </div>
                                </div>
                            </div>
                            <!--bouton "i"-->
                            <a href="<?php echo '#'.$LgnCatSuiv["id_categorie"].''; ?>" class="glyphicon glyphicon-info-sign <?php echo 'modal'.$LgnCatSuiv["id_categorie"].''; ?>" name="<?php echo $LgnCatSuiv["nom_cat"]; ?>"></a>
                            <!--definition du bouton-->
                            <a class="btn btn-primary btnparcours" href="categorie.php?idCat=<?php echo $LgnCatSuiv["id_categorie"]; ?>&niv=<?php echo $niv + 1; ?>"><?php echo $LgnCatSuiv["nom_cat"]; ?></a>
                            <!-- definition de la boite modal -->
                            <script type="text/javascript">
                                $("<?php echo '.modal'.$LgnCatSuiv["id_categorie"].''; ?>").fancybox({
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
                        <br>
                        <?php
                    } else {
                        ?>
                        <!-- affichage d'un bouton + d'un icone de modal mais invisible (par soucis d'alignement avec les autres boutons) -->
                        <div class="col-sm-offset-5">
                            <!-- icon de modal invisible -->
                            <a class="glyphicon glyphicon-info-sign" style="color: transparent" name="<?php echo $LgnCatSuiv["nom_cat"]; ?>"></a>
                            <!-- definition du bouton -->
                            <a class="btn btn-primary btnparcours" href="categorie.php?idCat=<?php echo $LgnCatSuiv["id_categorie"]; ?>&niv=<?php echo $niv + 1; ?>"><?php echo $LgnCatSuiv["nom_cat"]; ?></a>
                        </div>
                        <br>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
            </article>
            <?php
            mysqli_free_result($TabCatSuiv);
        }
        //libère la ressource TabDef
        mysqli_free_result($TabFin);
        //ferme la base de donnée
        mysqli_close($BDD);
        ?>
    </section>
    <div class="row" id="rFooter">
        <?php include("bas.php"); ?>
    </div>
</div>
<!-- definition de la flèche précédent -->
<?php
//si on est à la première "profondeur" des catégories
if($niv == 1){
    ?>
    <!-- retour à une page de deficience -->
    <a class="pagePreced" href="deficience.php?idDef=<?php echo $idDef;?>">
        <img class="logoRetour" src="images/retour_fleche.png">
    </a>
    <?php
    //sinon
}else {
    ?>
    <!-- retour à la page de catégories précédente -->
    <a class="pagePreced" href="categorie.php?idCat=<?php echo $tabCatId[$niv - 1] ; ?>&niv=<?php echo $niv - 1 ;?>">
        <img class="logoRetour" src="images/retour_fleche.png">
    </a>
    <?php
}
//profondeur -1
$niv = $niv-1;
?>
<!--Changement de feuille de style-->
<a class="btn btn-primary changeContraste" href="#" onclick="changeContrast()">Contraste élevé</a>
<script>
    function changeContrast() {
        console.log($('#css').attr('href'));
        if($('#css').attr('href') == 'mise_en_forme.css') {
            $('#css').replaceWith('<link id=css rel=stylesheet href=mise_en_forme_contrast.css>');
            $('.changeContraste').text('Contraste standard');
        }else{
            $('#css').replaceWith('<link id=css rel=stylesheet href=mise_en_forme.css>');
            $('.changeContraste').text('Contraste élevé');
        }
    }
</script>
</body>
</html>