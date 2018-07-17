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
            Ce site présente un catalogue de dispositifs et aides techniques à la communication,
            destiné à toutes personnes en situation de handicap, leurs proches ainsi que les professionnels de santé.
        </p>
    </div>

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec boutons deficiences + modals d'informations-->
    <section class="row" id="rSect">
        <div class="titremilieu"> Deux axes <br> de <br> recherche</div>
    </section>
        <article>
        <div class="row" >
            <div class="col-md-offset-2 col-md-4 bar" >
                <div class=" chart " id="niveau1B" href="#bouton"  onclick="afficherMasquerNiveau('niveau1')">
                        <div class="iconechiffre" >1</div>
                </div>
                <div class="texte" id="niveau1B" href="#bouton"  onclick="afficherMasquerNiveau('niveau1')">
                    <p>Type de handicap</p>
                </div>
            </div>
            <div class="col-md-4 bar" >
                <div class=" chart " id="niveau2B" href="#bouton"  onclick="afficherMasquerNiveau('niveau2')">
                        <div class="iconechiffre">2</div>
                </div>
                <div class="texte"  id="niveau2B" href="#bouton"  onclick="afficherMasquerNiveau('niveau2')">
                    <p>Situation d'usage</p>
                </div>
            </div>
        </div>
        </br></br>
        <?php
        // Connexion à la base de données
        require("connect.php");
        mysqli_set_charset($BDD, "utf8");
        // Recherche et affichage (hyperlien) de toutes les déficiences et situations
        $RqtSit="SELECT * FROM situation";
        $TabSit= mysqli_query($BDD, $RqtSit);
        $LgnSit = mysqli_fetch_array($TabSit);
   
        $RqtDef = "SELECT * FROM deficience";
        $TabDef = mysqli_query($BDD, $RqtDef); 
        $LgnDef = mysqli_fetch_array ($TabDef)
        
        ?>
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
        
        <div class="niveau">

            <div class="horL" id="niveau1"  style="display:none;">
                <div class="container">
                    <div class="row about">
                        <div class="col-md-6">
                            <div class="about1">
                            <a href="deficience.php?idDef=1">
                            <img class="ImageRecherche pic1Ab"  src="images/Visuel.png" />
                                <h3>Déficiences visuelles</h3></a>
                                <p>
                                    La vision est un des sens primordiaux dans la communication.<a href="<?php echo '#'.$LgnDef["id_deficience"].''; ?>" class="<?php echo 'modal'.$LgnDef["id_deficience"].''; ?>" name="<?php echo $LgnDef["nom_def"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="deficience.php?idDef=2">
                            <img class="ImageRecherche pic2Ab" src="images/Auditif.png" />
                                <h3>Déficiences auditives</h3></a>
                                <p>
                                    Les déficiences auditives peuvent être un frein à la communication. <a href="<?php echo '#'.$LgnDef["id_deficience"].''; ?>" class="<?php echo 'modal'.$LgnDef["id_deficience"].''; ?>" name="<?php echo $LgnDef["nom_def"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
            
                <div class="container">
                    <div class="row about">
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="deficience.php?idDef=3">                          
                            <img class="ImageRecherche pic1Ab" src="images/Moteur.png" />
                                <h3>Déficiences motrices</h3></a>
                                <p>
                                    Pour communiquer, il est souvent nécessaire d’utiliser ses membres supérieurs. <a href="<?php echo '#'.$LgnDef["id_deficience"].''; ?>" class="<?php echo 'modal'.$LgnDef["id_deficience"].''; ?>" name="<?php echo $LgnDef["nom_def"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>

                                </p>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="deficience.php?idDef=4">
                            <img class="ImageRecherche pic2Ab" src="images/Mental.png" />
                                <h3>Déficiences mentales et psychiques</h3></a>
                                <p>
                                    Le handicap mental (retard mental, dans le langage courant) est un trouble généralisé... <a href="<?php echo '#'.$LgnDef["id_deficience"].''; ?>" class="<?php echo 'modal'.$LgnDef["id_deficience"].''; ?>" name="<?php echo $LgnDef["nom_def"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            
                <div class="container">
                    <div class="row about">
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="deficience.php?idDef=5">
                            <img class="ImageRecherche pic1Ab" src="images/Parole.png" />
                                <h3>Déficiences de la parole et du langage</h3></a>
                                <p>        
                                    L’usage de la parole et du langage dans la communication est primordial. <a href="<?php echo '#'.$LgnDef["id_deficience"].''; ?>" class="<?php echo 'modal'.$LgnDef["id_deficience"].''; ?>" name="<?php echo $LgnDef["nom_def"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="horL2" id="niveau2"  style="display:none;">
                <div class="container">
                    <div class="row about">
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="situation.php?idSit=1">
                            <img class="ImageRecherche pic1Ab"  src="images\Manger.png" />
                                <h3>Repas</h3></a>
                                <p>
                                Le repas est un élèment essentiel de la vie de tous les jours <span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about1">
                            <a href="situation.php?idSit=2">
                            <img class="ImageRecherche pic2Ab" src="images\École travail.png" />

                                <h3>École-Travail</h3></a>

                                <p>
                                    L'école et le travail sont des lieux importants où la situ ation de handicap est importante.<span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
            
                <div class="container">
                    <div class="row about">
                        <div class="col-md-6">
                            <div class="about1">
                            <a href="situation.php?idSit=3">                          
                            <img class="ImageRecherche pic1Ab" src="images/Loisirs.png" />
                                <h3>Loisirs</h3></a>
                                <p>
                                Les jeux sont des moments précieux pour pouvoir décompresser <span class="listeBleue">[Lire la suite]</span></a>

                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="situation.php?idSit=4">
                            <img class="ImageRecherche pic2Ab" src="images/Soins.png" />
                                <h3>Soins-Traitement</h3></a>

                                <p>
                                    L'accès au soin peut être rendu difficile de part une mauvaise gestion du handicap <span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <?php
        //libère la ressource TabSit
        mysqli_free_result($TabSit);
        //libère la ressource TabDef
        mysqli_free_result($TabDef);
        //ferme la base de donnée
        mysqli_close($BDD);
        ?>

        </article>
    <footer class="row">
        <div class="col-lg-12">
            <?php include("bas.php"); ?>
        </div>
    </footer>
</div>

</body>
<script type="text/javascript">		
            function afficherMasquerNiveau(id) {
                document.getElementById(id).style.display="block";
                document.getElementById(id+"B").style.borderRadius= '50%';
                document.getElementById(id+"B").style.backgroundColor="#00ABDC";
                document.getElementById(id+"B").style.color="white";
            if (id=="niveau1")	{

                document.getElementById("niveau2").style.display="none";
                document.getElementById(id+"B").style.borderRadius= '50%';
                document.getElementById("niveau2B").style.backgroundColor="";
                document.getElementById("niveau2B").style.color="#00ABDC";
            }
            else if (id=="niveau2")	{

                document.getElementById("niveau1").style.display="none";
                document.getElementById(id+"B").style.borderRadius= '50%';
                document.getElementById("niveau1B").style.backgroundColor="";
                document.getElementById("niveau1B").style.color="#00ABDC";
            }
            }
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
</html>
