<!DOCTYPE html>
<?php
// Connexion à la base de données
require("connect.php");
mysqli_set_charset($BDD, "utf8");

// Récupération du niveau et du nom de la catégorie sur laquelle on vient de cliquer
$recherche = $_POST["recherche"];
$tabRecherche = explode(' ',trim($recherche));
$tabResultats = array();

// on parcourt tous les dispositifs et on regarde pour lesquels il y a des correspondances dans : le dispositif (nom et texte), les catégories (noms et textes), et la déficience (nom et texte)
$RqtDispositifs = "SELECT * FROM dispositif";
$TabDispositifs = mysqli_query($BDD, $RqtDispositifs);
//parcours de tous les dispositifs
while ($LgnDispositifs = mysqli_fetch_array($TabDispositifs))
{
    $okAll = true;
    //on parcours tous les mots de la recherche
    foreach ($tabRecherche as $mot)
    {
        //test : mot différent de chaine vide
        if ($mot != "")
        {
            $ok = false;
            //tous les tests se font avec des mots en lettres minuscules et sans accents
            $mot = callReplaceTable(strtolower(trim($mot)));
            // on regarde dans les métadonnées du dispositif
            if (strpos(callReplaceTable(strtolower($LgnDispositifs["nom_dis"])),$mot) || strpos(callReplaceTable(strtolower($LgnDispositifs["description"])),$mot)) $ok = true;
            if (!$ok)
            {
                // on regarde dans les métadonnées de la catégorie
                $RqtCatDis = "SELECT * FROM categorie WHERE id_categorie = ".$LgnDispositifs["id_cat_dis"];
                $TabCatDis = mysqli_query($BDD, $RqtCatDis);
                $LgnCatDis = mysqli_fetch_array($TabCatDis);
                if (strpos(callReplaceTable(strtolower($LgnCatDis['nom_cat'])),$mot) || strpos(callReplaceTable(strtolower($LgnCatDis['texte_cat'])),$mot)) $ok = true;
                if (!$ok)
                {
                    // on regarde dans les métadonnées des catégories précédentes
                    $cat = $LgnCatDis['id_cat_prec'];
                    while ($cat != null)
                    {
                        $RqtCatPrec = "SELECT * FROM categorie WHERE id_categorie = ".$cat;
                        $TabCatPrec = mysqli_query($BDD, $RqtCatPrec);
                        $LgnCatPrec = mysqli_fetch_array($TabCatPrec);
                        if (strpos(callReplaceTable(strtolower($LgnCatPrec['nom_cat'])),$mot) || strpos(callReplaceTable(strtolower($LgnCatPrec['texte_cat'])),$mot)) $ok = true;
                        $cat = $LgnCatPrec['id_cat_prec'];

                        mysqli_free_result($TabCatPrec);
                    }
                    if (!$ok && $LgnCatPrec['id_def_cat'] != null)
                    {
                        // on regarde dans les métadonnées de la déficience
                        $RqtDefCatDis = "SELECT * FROM deficience WHERE id_deficience = ".$LgnCatPrec['id_def_cat'];
                        $TabDefCatDis = mysqli_query($BDD, $RqtDefCatDis);
                        $LgnDefCatDis = mysqli_fetch_array($TabDefCatDis);
                        if (strpos(callReplaceTable(strtolower($LgnDefCatDis['nom_def'])),$mot) || strpos(callReplaceTable(strtolower($LgnDefCatDis['texte_def'])),$mot)) $ok = true;

                        mysqli_free_result($TabDefCatDis);
                    }
                }

                mysqli_free_result($TabCatDis);
            }
            if (!$ok) $okAll = false;
        }
    }
    if ($okAll) $tabResultats[] = $LgnDispositifs['id_dispositif'];
}
mysqli_free_result($TabDispositifs);

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>DATÀC – Recherche</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="mise_en_forme.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script href="bootstrap/js/bootstrap.js"></script>
    <script href="bootstrap/js/npm.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body>
<!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
<div class="container-fluid">

    <!--header = bannière blance avec logos, connexion et recherche + titre sur fond bleu-->
    <?php include ("header.php"); ?>

    <!--suite bannière bleu (après titre)-->
    <div class="row" id="rArianne">
        <!--Fil d’Ariane-->
        <p class="ariane col-sm-offset-1">
            <a class="ariane" href="accueil.php">Accueil</a> // <?php echo "Recherche : « ".$recherche." »"; ?>
        </p>
    </div>

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec résultats de la recherche-->
    <section class="row" id="rSect">

        <article>
            <?php
            //test : il y a au moins un résultat à la recherche
            if (count($tabResultats) != 0)
            {
                //séléction des résultats
                $RqtResultatsDis = "SELECT * FROM dispositif WHERE id_dispositif IN (".implode(',',$tabResultats).") ORDER BY nom_dis";
                $TabResultatsDis = mysqli_query($BDD, $RqtResultatsDis);

                echo '<p class="sousTitre">Il existe les produits suivants :</p> <br>';

                // affichage des résultats
                while ($LgnResultatsDis = mysqli_fetch_array($TabResultatsDis))
                {
                    ?>
                    <p class="liste_produit resultatRecherche">
                        <a class="resultatRecherche" href="dispositif.php?idDis=<?php echo $LgnResultatsDis["id_dispositif"]; ?>"><?php echo $LgnResultatsDis["nom_dis"]; ?></a>
                    </p>
                    <?php
                }
                mysqli_free_result($TabResultatsDis);
            }
            else
            {
                echo '<p class="sousTitre"> Pas de résultats</p>';
            }

            mysqli_close($BDD);

            //fonction permettant de transformer toutes les lettres avec des accents en lettres sans accents
            function callReplaceTable($initial) {
                $TB_CONVERT = array(
                    'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
                    'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
                    'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
                    'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
                    'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
                    'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
                    'ú' => 'u', 'û' => 'u', 'ü'=>'u','ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f', 'œ' => 'oe'
                );

                $s = strtr($initial, $TB_CONVERT);

                return $s;
            }

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