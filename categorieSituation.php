<!DOCTYPE html>
<?php
// Connexion à la base de données
require("connect.php");
mysqli_set_charset($BDD, "utf8");


// Récupération des variables
$idSousSit =  htmlentities($_GET["idSsSit"]);
$idCat = htmlentities($_GET["idCat"]);
$idSit =  htmlentities($_GET["idSit"]);
$nivCat=htmlentities($_GET["niv"]);

// Récupération du nom de la catégorie sur laquelle on vient de cliquer
$RqtCat="SELECT * FROM categorie WHERE id_categorie = $idCat";
$TabCat = mysqli_query($BDD, $RqtCat);
$LgnCat = mysqli_fetch_array($TabCat);
$idCatPrec=$LgnCat['id_cat_prec'];
$nomCat = $LgnCat["nom_cat"];


// Récupération du nom de la situation

$RqtSit = "SELECT * FROM situation WHERE id_sit_cat = $idSit AND niveau=1";
$TabSit = mysqli_query($BDD, $RqtSit);
$LgnSit = mysqli_fetch_array($TabSit);
$nomSit = $LgnSit["nom_sit"];

$RqtSousSit="SELECT * FROM situation WHERE id_situation=$idSousSit";
$TabSousSit = mysqli_query($BDD, $RqtSousSit);
$LgnSousSit = mysqli_fetch_array($TabSousSit);
$nomSousSit=$LgnSousSit['nom_sit'];
// $idSousSit=$LgnSit['id_sit_cat'];

$TabCategorie[0]=$nomSousSit;
$TabCategorie[$nivCat]=$nomCat;

$bool=true;

for ($i = 1; $i < $nivCat; $i++) {
    $RqtCatPrec = "SELECT * FROM categorie WHERE id_categorie = $idCatPrec";
    $TabCatPrec = mysqli_query($BDD, $RqtCatPrec);
    if (mysqli_num_rows($TabCatPrec) != 0) {
        $LgnCatPrec = mysqli_fetch_array($TabCatPrec);
        $TabCategorie[$nivCat - $i] = $LgnCatPrec["nom_cat"];
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
    
    <!--suite bannière bleu (après titre)-->
    <div class="row" id="rArianne">
        <!--Fil d’Ariane-->
        <p class="ariane col-sm-offset-1">
            <a class="ariane" href="accueil.php">Accueil</a>

            // <a class="fAriane" href="situation.php?idSit=<?php echo $idSit; ?>"><?php echo $nomSit ?> // <?php echo $TabCategorie[0]; ?></a>
            <?php  
            for ($i = 1; $i <= $nivCat; $i++) 
            {
            ?>
            // <?php echo $TabCategorie[$i]; ?>
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
        $RqtFin = "SELECT * FROM categorie WHERE id_cat_prec=$idCat " ;
        $TabFin = mysqli_query($BDD, $RqtFin);
        // Et s’il existe des dispositifs dans la catégorie sur laquelle on vient de cliquer
        $RqtFnl = "SELECT * FROM dispositif WHERE id_cat_dis = $idCat ";
        $TabFnl = mysqli_query($BDD, $RqtFnl);
        // Si il y a des dispositifs on génère la page d’affichage de la liste de ces dispositifs
        if (mysqli_num_rows($TabFnl) != 0 || mysqli_num_rows($TabFin) == 0) 
        {
            ?>
            <article>
                <p class="col-sm-offset-1 col-sm-10 sousTitre">Il existe les produits suivants :</p>
                <?php
                // Recherche et affichage de tous les dispositifs relatifs à la catégorie choisie
                $RqtDis = "SELECT * FROM dispositif WHERE id_cat_dis = $idCat ";
                $TabDis = mysqli_query($BDD, $RqtDis);
                while ($LgnDis = mysqli_fetch_array($TabDis)) {
                    ?>
                    <!--boutons des dispositifs-->
                    <div class="col-sm-offset-5">
                        <a class="btn btn-primary btnparcours" href="dispositif.php?bool=<?php echo $bool ?>&idSit=<?php echo $idSit ?>&idSsSit=<?php echo $idSousSit ?>&idDis=<?php echo $LgnDis["id_dispositif"]; ?>"><?php echo $LgnDis["nom_dis"]; ?></a>
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
        if (mysqli_num_rows($TabFin) != 0) 
        {
            ?>
            <article>
                <p class="col-sm-offset-1 col-sm-10 sousTitre">Il existe les catégories suivantes :</p>
                <br>
                <br>
                <br>
                <?php

                

                /*$query = "SELECT * FROM categorie WHERE id_cat_prec = $idCat AND id_categorie IN "
                . "(SELECT id_categorie FROM association_situation_categorie WHERE id_situation = $idSousSit)";

                $stmt = $BDD->query($query);

                while($data = $stmt->fetch_assoc()) {
                    echo'<pre>';
                    var_dump($data);
                    echo '</pre>';
                    echo $data['nom_cat'];
                }
                exit;*/

                // Recherche et affichage des toutes les sous-catégories relatives à la catégorie choisie
                $query = "SELECT * FROM categorie WHERE id_cat_prec = $idCat AND id_categorie IN "
                . "(SELECT id_categorie FROM association_situation_categorie WHERE id_situation = $idSousSit)";

                $stmt = $BDD->query($query);

                while($data = $stmt->fetch_assoc()) 
                {
                        ?>
                        <?php
                        // Affichage d'une description (modal) en plus du bouton s'il y en a une
                        if ($data["texte_cat"] != NULL OR $data["texte_cat"] != "") 
                        {
                            ?>
                            <div class="col-sm-offset-5">
                                <!--definition d'un modal -->
                                <div style="display:none">
                                    <div id="<?php echo $data["id_categorie"]; ?>" class="modal-container">
                                        <div class="modal-title"><?php echo $data["nom_cat"]; ?></div>
                                        <div class="modal-body">
                                            <p class="descrp"><?php echo $data["texte_cat"]; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!--bouton "i"-->
                                <a href="<?php echo '#'.$data["id_categorie"].''; ?>" class="glyphicon glyphicon-info-sign <?php echo 'modal'.$data["id_categorie"].''; ?>" name="<?php echo $data["nom_cat"]; ?>"></a>
                                <!--definition du bouton-->
                                <a class="btn btn-primary btnparcours" href="categorieSituation.php?idSit=<?php echo $idSit ?>&idSsSit=<?php echo $idSousSit ?>&idCat=<?php echo $data["id_categorie"]; ?>&niv=<?php echo $nivCat +1; ?>"><?php echo $data["nom_cat"]; ?></a>

                                <!-- definition de la boite modal -->
                                <script type="text/javascript">
                                    $("<?php echo '.modal'.$data["id_categorie"].''; ?>").fancybox({
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
                        } 
                        else 
                        {
                            ?>
                            <!-- affichage d'un bouton + d'un icone de modal mais invisible (par soucis d'alignement avec les autres boutons) -->
                            <div class="col-sm-offset-5">
                                <!-- icon de modal invisible -->
                                <a class="glyphicon glyphicon-info-sign" style="color: transparent" name="<?php echo $data["nom_cat"]; ?>"></a>
                                <!-- definition du bouton -->
                                <a class="btn btn-primary btnparcours" href="categorieSituation.php?idSit=<?php echo $idSit ?>&idSsSit=<?php echo $idSousSit ?>&idCat=<?php echo $data["id_categorie"]; ?>&niv=<?php echo $nivCat +1; ?>"><?php echo $data["nom_cat"]; ?></a>

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
<!-- definition de la flèche précédent (retour à accueil) -->
<a class="pagePreced" href="situation.php?idSit=<?php echo $idSit ?>"><img class="logoRetour" src="images/retour_fleche.png"> </a>
</html>