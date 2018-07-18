<!DOCTYPE html>
<?php
// Connexion à la base de données
require("connect.php");
mysqli_set_charset($BDD, "utf8");

// Récupération de l'identifiant du dispositif sur lequel on vient de cliquer

$idDis = htmlentities($_GET["idDis"]);
$BoolSituation=htmlentities($_GET["bool"]);

if ($BoolSituation==true)
{
    $idSousSit =  htmlentities($_GET["idSsSit"]);
    $idSit =  htmlentities($_GET["idSit"]);

    // Récupération des informations liées à la situation
    $RqtSit = "SELECT * FROM situation WHERE id_sit_cat = $idSit AND niveau=1";
    $TabSit = mysqli_query($BDD, $RqtSit);
    $LgnSit = mysqli_fetch_array($TabSit);
    $nomSit = $LgnSit["nom_sit"];

    // Récupération des informations liées à la sous situation
    $RqtSousSit="SELECT * FROM situation WHERE id_situation=$idSousSit";
    $TabSousSit = mysqli_query($BDD, $RqtSousSit);
    $LgnSousSit = mysqli_fetch_array($TabSousSit);
    $nomSousSit=$LgnSousSit['nom_sit'];

}


// Récupération des informations liées au dispositif
$RqtDis = "SELECT * FROM dispositif WHERE id_dispositif = $idDis";
$TabDis = mysqli_query($BDD, $RqtDis);
$LgnDis = mysqli_fetch_array($TabDis);
mysqli_free_result($TabDis);

// Assignation à des variables
$nomDis = $LgnDis["nom_dis"];
$description = $LgnDis["description"];
$idCat = $LgnDis["id_cat_dis"];
$idSiteFab = $LgnDis["id_site_fab"];

//Récupération du/des prix du dispositif
$RqtPrix = "SELECT * FROM prix WHERE id_dis_prix = $idDis";
$TabPrix = mysqli_query($BDD, $RqtPrix);

// Assignation du/des prix et des sites correspondants dans un tableau
$tableauPrixSiteV = array();
$i = 0;

while ($LgnPrix = mysqli_fetch_array($TabPrix)) {
    $idPrix = $LgnPrix["id_prix"];
    $prix = $LgnPrix["prix"];

    //test : le dispositif a un site de vente ?
    if ($LgnPrix["id_site_vente"] != NULL) {
        // Récupération du site vendeur correspondant au prix
        $RqtVend = "SELECT * FROM site WHERE id_site = " . $LgnPrix["id_site_vente"];
        $TabVend = mysqli_query($BDD, $RqtVend);
        $LgnVend = mysqli_fetch_array($TabVend);
        mysqli_free_result($TabVend);

        $urlSiteVend = $LgnVend["url"];
        $nomSiteVend = $LgnVend["nom_site"];
    } else {
        $urlSiteVend = "";
        $nomSiteVend = "";
    }

    // Assignation des données dans un tableau
    $tableauPrixSiteV[$i] = array($prix, $urlSiteVend, $nomSiteVend);

    $i++;
}

// Nombre de prix pour un dispositif
$nbPrix = $i;

// Récupération du site fabricant
if ($idSiteFab != NULL) {
    $RqtFab = "SELECT url, nom_site FROM site WHERE id_site = $idSiteFab";
    $TabFab = mysqli_query($BDD, $RqtFab);
    $LgnFab = mysqli_fetch_array($TabFab);
    mysqli_free_result($TabFab);

    $urlSiteFab = $LgnFab["url"];
    $nomSiteFab = $LgnFab["nom_site"];
} else {
    $urlSiteFab = "";
    $nomSiteFab = "";
}

// Récupération d’informations pour le fil d’Ariane
$RqtFil = "SELECT nom_def, nom_cat, niveau, id_deficience, id_cat_prec FROM categorie, deficience WHERE id_def_cat = id_deficience AND id_categorie = $idCat";
$TabFil = mysqli_query($BDD, $RqtFil);
$LgnFil = mysqli_fetch_array($TabFil);
mysqli_free_result($TabFil);

// Assignation à des variables
$nomDef = $LgnFil["nom_def"];
$nomCat = $LgnFil["nom_cat"];
$niv = $LgnFil["niveau"];
$idDef = $LgnFil["id_deficience"];
$idCatPrec = $LgnFil["id_cat_prec"];

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

    //test : tableau non vide
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
    <title>DATÀC – <?php print $nomDis; ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link id="css" rel="stylesheet" href="mise_en_forme.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script href="bootstrap/js/bootstrap.js"></script>
    <script href="bootstrap/js/npm.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- import pour zoom sur images -->
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

            //
            <?php
            if(isset($_GET["idSit"]))
            { 
                ?>
                <a class="fAriane" href="situation.php?idSit=<?php echo $idSit; ?>"><?php echo $nomSit ?> // <?php echo $nomSousSit; ?></a>
                <?php
                 for ($i = 1; $i <= $niv; $i++) {
                    ?>
                    // <?php echo $tabCat[$i]; ?>
                    <?php
                }
            }
            else
            {
                ?>
                <a class="fAriane" href="deficience.php?idDef=<?php echo $tabCatId[0]; ?>"><?php echo $tabCat[0]; ?></a>
                <?php
                // Pour les sous-catégories
                for ($i = 1; $i <= $niv; $i++) {
                    ?>
                    // <a class="fAriane"
                        href="categorie.php?idCat=<?php echo $tabCatId[$i]; ?>&niv=<?php echo $i; ?>"><?php echo $tabCat[$i]; ?></a>
                    <?php
                }
                // nom du dispositif
            }
                ?>
            // <?php echo $nomDis; ?>

        </p>
    </div>

    <!--fond bleu penché-->
    <div class="row penche"></div>

    <section>
        <article>
            <?php
            // Affichage du nom du dispositif et de sa description
            ?>
            <!--nom dispositif -->
            <div class="row">
                <p class="titre_dispositif col-sm-offset-1 col-sm-10"><?php echo $nomDis; ?></p>
            </div>
            <!-- image dispositif -->
            <div class="row">
                <!-- definition de la "boite" pour zoom sur image -->
                <a class="col-sm-offset-1 col-sm-4" data-fancybox data-caption="<?php echo $LgnDis["nom_dis"]; ?>" href="images/<?php echo $LgnDis["image"]; ?>" >
                    <img class="img-responsive imgDisp" src="images/<?php echo $LgnDis["image"]; ?>" alt="<?php echo $LgnDis["nom_dis"]; ?>"/>
                </a>

                <p class="col-sm-6 descriptionProduit"><?php echo $description; ?></p>
            </div>
            <?php
            // Affichage tableau avec site(s) de vente et prix correspondant(s)
            ?>
            <br>
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                        <table class="table table-bordered">
                            <tr class="dispositif info">
                                <th class="dispositif">Prix et site(s) de vente :</th>
                                <td><?php
                                    if ($nbPrix != 0)
                                    {
                                        for ($i = 0;
                                             $i < $nbPrix;
                                             $i++)
                                        {
                                            echo $tableauPrixSiteV[$i][0];

                                            if ($tableauPrixSiteV[$i][1] != "")
                                            {
                                                ?> vu sur <a href="http://<?php echo $tableauPrixSiteV[$i][1]; ?>" class="tablink"
                                                             target="_blank"><?php echo $tableauPrixSiteV[$i][2]; ?></a><br/><?php
                                            }

                                            else {
                                                echo " sur " . $tableauPrixSiteV[$i][2];
                                            }
                                        }
                                    }

                                    else {
                                        echo "Inconnus";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            // Affichage du site du fabricant
                            if ($urlSiteFab != "") {
                                ?>
                                <tr class="dispositif active">
                                    <th class="dispositif">Site du fabricant :</th>
                                    <td><a href="http://<?php echo $urlSiteFab; ?>" class="tablink" target="_blank"> <?php echo $nomSiteFab; ?></a>
                                    </td>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <th class="dispositif">Site du fabricant :</th>
                                    <td>Inconnu</td>
                                </tr>
                                <?php
                            }

                            //lien vers les dispositifs de la même catégorie
                            $ReqSim = "SELECT * FROM dispositif WHERE id_cat_dis = " . $idCat . " AND id_dispositif <> " . $idDis;
                            $TabSim = mysqli_query($BDD, $ReqSim);

                            if (mysqli_num_rows($TabSim) != 0)
                            {
                                ?>
                                <tr class="dispositif info">
                                    <th class="dispositif">Voir aussi :</th>
                                    <td>
                                        <?php
                                        while ($LgnSim = mysqli_fetch_array($TabSim)) {
                                            ?>
                                            <a href="dispositif.php?idDis=<?php echo $LgnSim["id_dispositif"]; ?>" class="tablink"><?php echo $LgnSim["nom_dis"]; ?></a>
                                            <br/>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            //fermeture de la base de données
                            mysqli_close($BDD);
                            ?>
                        </table>
                    </div>

            </div>
        </article>
    </section>
    <div class="row" id="rFooter">
        <?php include("bas.php"); ?>
    </div>
    <!-- retour à la page de choix de dispositif précédente -->
    <a class="pagePreced" href="categorie.php?idCat=<?php echo $tabCatId[$niv];?>&niv=<?php echo $niv; ?>"><img class="logoRetour" src="images/retour_fleche.png"> </a>
     
    
   
</div>
</body>
</html>