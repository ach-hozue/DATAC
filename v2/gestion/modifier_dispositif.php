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
    <title>DATÀC – Modifier un dispositif</title>
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
    // Tableau pour ranger les identifiants des catégories sélectionnées
    $SelectionsBis = array();

    // Rangement de la déficience
    $SelectionsBis[0] = isset($_POST["defBis"])?$_POST["defBis"] :null;

    if(isset($_POST["defBis"]))
    {
        // Détermination du niveau maximal que l’on peut atteindre
        $ReqNivBis = "SELECT MAX(niveau) FROM categorie WHERE id_def_cat = ".$_POST["defBis"];
        $TabNivBis = mysqli_query($BDD,$ReqNivBis);
        $NiveauBis = mysqli_fetch_array($TabNivBis)["MAX(niveau)"];

        // Rangement des catégories
        for($i = 1; $i <= $NiveauBis; $i++)
        {
            $SelectionsBis[$i] = isset($_POST["catBis$i"])?$_POST["catBis$i"] :null;
        }

        $_idDis = isset($_POST["_idDis"])?$_POST["_idDis"] :null;
    }
    ?>
    <!--bannière grise avec choix de la déficience de la catégorie et des sous-catégories puis du dispositif
        et enfin les champs pour modifier le dispositif-->
    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <h3>Sélectionnez le dispositif que vous voulez modifier</h3>
            <form method="post" id="choix" enctype="multipart/form-data">
                <div class="form-group">
                    <select class="form-control" name = "defBis" id = "niveau0" onChange = "document.forms['choix'].submit();">
                        <option value = "0">--- Choisissez une déficience ---</option>
                        <?php
                        $ReqBis = "SELECT * FROM deficience";
                        $TabBis = mysqli_query($BDD,$ReqBis);

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
                            $TabBis = mysqli_query($BDD,$ReqBis);

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
                            $TabBis = mysqli_query($BDD,$ReqBis);

                            // Et s’il existe bien une sous-catégorie
                            if(mysqli_num_rows($TabBis) != 0)
                            {
                                ?>
                                <!-- Choix de la catégorie de niveau <?php echo $i; ?> -->
                                <div class="form-group">
                                    <select class="form-control" name = "catBis<?php echo $i; ?>" id = "niveau<?php echo $i; ?>" onChange = "document.forms['choix'].submit();">
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
                            if(mysqli_num_rows($TabDis)!= 0)
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

                if(isset($_idDis) && $_idDis != 0)
                {
                    // Récupération des informations du dispositif
                    $RqtRecup = "SELECT * FROM dispositif WHERE id_dispositif = $_idDis";
                    $TabRecup = mysqli_query($BDD, $RqtRecup);
                    $LecRecup = mysqli_fetch_array($TabRecup);

                    // Assignation des informations du dispositif
                    $nom = $LecRecup["nom_dis"];
                    $description = $LecRecup["description"];
                    $idSiteFab = $LecRecup["id_site_fab"];
                    $image = $LecRecup["image"];

                    // Récupération du site du fabricant
                    if(!empty($idSiteFab))
                    {
                        $RqtSiteFab = "SELECT * FROM site WHERE id_site = $idSiteFab";
                        $TabSiteFab = mysqli_query($BDD, $RqtSiteFab);
                        if(mysqli_num_rows($TabSiteFab) != 0) { $LecSiteFab = mysqli_fetch_array($TabSiteFab); }
                    }

                    // Assignation des informations du site du fabricant
                    $nomSiteF = isset($LecSiteFab['nom_site'])?$LecSiteFab['nom_site']:null;
                    $urlSiteF = isset($LecSiteFab['url'])?$LecSiteFab['url']:null;

                    // Récupération du prix
                    $RqtPrix = "SELECT * FROM prix WHERE id_dis_prix = $_idDis";
                    $TabPrix = mysqli_query($BDD, $RqtPrix);
                    if(mysqli_num_rows($TabPrix) != 0) { $LecPrix = mysqli_fetch_array($TabPrix); }

                    // Assignation des informations des informations du prix
                    $idSite = isset($LecPrix['id_site_vente'])?$LecPrix['id_site_vente']:null;
                    $prix = isset($LecPrix['prix'])?$LecPrix['prix']:null;

                    if(!empty($idSite))
                    {
                        // Récupération du site de vente
                        $RqtSiteVente = "SELECT * FROM site WHERE id_site = $idSite";
                        $TabSiteVente = mysqli_query($BDD, $RqtSiteVente);
                        if(mysqli_num_rows($TabSiteVente) != 0) { $LecSiteVente = mysqli_fetch_array($TabSiteVente); }
                    }

                    // Assignation des informations du site de vente
                    $nomSiteV = isset($LecSiteVente['nom_site'])?$LecSiteVente['nom_site']:null;
                    $urlSiteV = isset($LecSiteVente['url'])?$LecSiteVente['url']:null;
                    ?>
                    <h3>Nom, description et image du dispositif</h3>

                    <div class="form-group">
                        <label for="name">Nom du dispositif <sup style = "color : red">*</sup> :</label>
                        <input type="text" class="form-control" id="name" name = "_nom" value = "<?php echo $nom;?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Desription du dispositif <sup style = "color : red">*</sup> :</label>
                        <textarea class="form-control" rows=5 id="description" name = "_description" value = "<?php echo $description; ?>" required><?php echo $description; ?></textarea>
                    </div>
                    <p>
                        Image du dispositif :
                        <input type = "file" name = "_fichier" class="choixImage" />
                    </p>

                    <h3>Prix et site(s) de vente</h3>

                    <div class="form-group">
                        <label for="siteVente">Nom du site de vente <sup style = "color : red">*</sup> :</label>
                        <input type="text" class="form-control" id="siteVente" name = "_nomSiteVente1" value = "<?php echo $nomSiteV; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="urlVente">Lien du site de vente <sup style = "color : red">*</sup> :</label>
                        <input type="url" class="form-control" id="urlVente" name = "_urlSiteVente1" value = "<?php echo $urlSiteV; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix correspondant <sup style = "color : red">*</sup> :</label>
                        <input type="text" class="form-control" id="prix" name = "_prix1" value = "<?php echo $prix; ?>" required>
                    </div>

                    <h3>Site du fabricant</h3>

                    <div class="form-group">
                        <label for="siteFab">Nom du site du fabricant :</label>
                        <input type="text" class="form-control" id="siteFab" name = "_nomSiteFab" value = "<?php echo $nomSiteF; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lienFab">Lien du site du fabricant :</label>
                        <input type="url" class="form-control" id="lienFab" name = "_nomSiteFab" value = "<?php echo $urlSiteF; ?>">
                    </div>
                    <p><sup style = "color : red">*</sup> : Champ obligatoire</p>
                    <button class="btn btn-primary" type="submit" name = "_modifier">Modifier</button>
                    <?php
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
if(isset($_POST["_modifier"]))
{
    if(isset($_POST['_idDis']) && $_POST['_idDis'] != 0)
    {
        $idDispo = $_POST['_idDis'];

        // Modification du site du fabricant
        if(!empty($_POST["_nomSiteFab"]) || !empty($_POST["_urlSiteFab"]))
        {
            if(!empty($_POST["_urlSiteFab"]))
            {
                // Vérification qu'il n'existe pas déjà
                $RqtRechSiteFab = "SELECT * FROM site WHERE url = '".$_POST['_urlSiteFab']."'";
                $TabRechSiteFab = mysqli_query($BDD,$RqtRechSiteFab);
                $LecRechSiteFab = mysqli_fetch_array($TabRechSiteFab);

                if($LecRechSiteFab == NULL)
                {
                    $RqtFab = "INSERT INTO site (nom_site, url) VALUES ('".((!empty($_POST["_nomSiteFab"]))?$_POST["_nomSiteFab"]:null)."', '".$_POST["_urlSiteFab"]."')";
                    mysqli_query($BDD, $RqtFab);

                    // Récupération de l'id du site
                    $RqtId = "SELECT LAST_INSERT_ID() AS id";
                    $TabId = mysqli_query($BDD,$RqtId);
                    $idSiteFab = mysqli_fetch_array($TabId)["id"];
                }

                else
                {
                    // Récupération de l'identifiant
                    $idSiteFab = $LecRechSiteFab['id_site'];
                }
            }

            else
            {
                // Vérification qu'il n'existe pas déjà
                $RqtRechSiteFab = "SELECT * FROM site WHERE nom_site = '".$_POST["_nomSiteFab"]."'";
                $TabRechSiteFab = mysqli_query($BDD,$RqtRechSiteFab);
                $LecRechSiteFab = mysqli_fetch_array($TabRechSiteFab);

                if($LecRechSiteFab == NULL)
                {
                    $RqtFab = "INSERT INTO site (nom_site) VALUES ('".$_POST["_nomSiteFab"]."')";
                    mysqli_query($BDD, $RqtFab);

                    // Récupération de l'id du site
                    $RqtId = "SELECT LAST_INSERT_ID() AS id";
                    $TabId = mysqli_query($BDD,$RqtId);
                    $idSiteFab = mysqli_fetch_array($TabId)["id"];
                }

                else
                {
                    // Récupération de l'identifiant
                    $idSiteFab = $LecRechSiteFab['id_site'];
                }
            }
        }

        else
        {
            $idSiteFab = null;
        }

        // Modification du dispositif
        $RqtDis = "UPDATE dispositif SET nom_dis = '".((!empty($_POST["_nom"]))?$_POST["_nom"]:$nom)."', description = '".((!empty($_POST["_description"]))?$_POST["_description"]:$description)."', id_site_fab = ".(!empty($idSiteFab)?$idSiteFab:"NULL")." WHERE id_dispositif = ".$_idDis;
        mysqli_query($BDD, $RqtDis);

        // Modification de l’image
        if(isset($_FILES["_fichier"]) AND $_FILES["_fichier"]["error"] == 0)
        {
            // Suppression de l’ancienne image si elle existe
            $RqtIma = "SELECT image FROM dispositif WHERE id_dispositif = ".$_idDis;
            $TabIma = mysqli_query($BDD, $RqtIma);

            if(mysqli_num_rows($TabIma) != 0)
            {
                $UrlIma = mysqli_fetch_array($TabIma)["image"];
                $UrlIma = "../images/".$UrlIma;
                unlink("$UrlIma");
            }

            $urlFichier = $_FILES["_fichier"]["name"];

            // Vérification que l’image n’existe pas déjà
            $RqtImg = "SELECT * FROM dispositif WHERE image = '".$urlFichier."'";
            $TabImg = mysqli_query($BDD, $RqtImg);
            $LecImg = mysqli_fetch_array($TabImg);
            mysqli_free_result($TabImg);

            if($LecImg != null)
            {
                $ReqNom = "UPDATE dispositif SET image = '".$LecImg["id_dispositif"]."_".$urlFichier."' WHERE id_dispositif = ".$LecImg["id_dispositif"];
                mysqli_query($BDD,$ReqNom);
                rename("../images/".$urlFichier,"../images/".$LecImg["id_dispositif"]."_".$urlFichier);
            }

            move_uploaded_file($_FILES["_fichier"]["tmp_name"],"../images/".basename($urlFichier));

            $RqtDis = "UPDATE dispositif SET image = '".$urlFichier."' WHERE id_dispositif = ".$_idDis;
            mysqli_query($BDD, $RqtDis);
        }

        // Modification du site de vente
        if(!empty($_POST["_nomSiteVente"]) && !empty($_POST["_urlSiteVente"]) && !empty($_POST["_prix"]))
        {
            // Vérification qu'il n'existe pas déjà
            $RqtRechSiteVente = "SELECT * FROM site WHERE url = '".$_POST['_urlSiteVente']."'";
            $TabRechSiteVente = mysqli_query($BDD,$RqtRechSiteVente);
            $LecRechSiteVente = mysqli_fetch_array($TabRechSiteVente);

            // S'il n'en existe pas
            if($LecRechSiteVente == NULL)
            {
                $RqtVente = "INSERT INTO site (nom_site, url) VALUES ('".$_POST["_nomSiteVente"]."', '".$_POST["_urlSiteVente"]."')";
                mysqli_query($BDD, $RqtVente);

                // Récupération de l'id du site
                $RqtId = "SELECT LAST_INSERT_ID() AS id";
                $TabId = mysqli_query($BDD,$RqtId);
                $idSite = mysqli_fetch_array($TabId)["id"];
            }

            else
            {
                // Récupération de l'identifiant
                $idSite = $LecRechSiteVente['id_site'];
            }
        }

        // Modification du prix
        if(!empty($idSite) && !empty($_POST["_prix"]))
        {
            // Cas où il y avait déjà un prix
            if(!empty($prix))
            {
                $RqtPrix = "UPDATE prix SET prix = '".$_POST["_prix"]."', id_site_vente = ".$idSite." WHERE id_dis_prix = ".$_idDis;
                mysqli_query($BDD, $RqtPrix);
            }

            // Cas où aucun prix n'était renseigné
            else
            {
                $RqtPrix = "INSERT INRO prix (prix, id_dis_prix, id_site_vente) VALUES ('".$_POST["_prix"]."', ".$_idDis.", '".$idSite."'";
                mysqli_query($BDD, $RqtPrix);
            }
        }

        // Message d'alerte
        ?>
        <script>
            alert("<?php echo htmlspecialchars('Le dispositif a bien été modifié !', ENT_QUOTES); ?>");
            window.location.href = 'accueil_gestionnaire.php';
        </script>
        <?php
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