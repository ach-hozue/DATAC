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
    <!--import pour le modal("i")-->
    <link href="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.css" rel="stylesheet">
    <script src="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.js"></script>

</head>
<body>
<!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
<div class="container-fluid">

    <!--Header = bannière blanche fixe en haut de l'écran-->
    <?php include("header.php"); ?>

    <!--suite bannière bleue (après titre)-->
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
            <h3>Veuillez sélectionner l'axe de votre choix :</h3><br>
            <div class="col-md-offset-2 col-md-4 bar col-sm-6 col-xs-6" >
                <div class=" chart " id="niveau1B" href="#bouton"  onclick="afficherMasquerNiveau('niveau1')">
                        <div class="iconechiffre" >1</div>
                </div>
                <div class="texte" id="niveau1B" href="#bouton"  onclick="afficherMasquerNiveau('niveau1')">
                    <p>Type de handicap</p>
                </div>
            </div>
            <div class="col-md-4 bar col-sm-6 col-xs-6" >
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
        $RqtDef = "SELECT * FROM deficience";
        $TabDef = mysqli_query($BDD, $RqtDef);
        $i=0; 
       while ($LgnDef = mysqli_fetch_array ($TabDef))
       {
           $tableau[$i]["id"]=$LgnDef["id_deficience"];
           $tableau[$i]["nom"]=$LgnDef["nom_def"];
           $tableau[$i]["texte"]=$LgnDef["texte_def"];
           ?>
           <div style="display:none">
           <div id="<?php echo  $tableau[$i]["id"]; ?>" class="modal-container">
               <div  class="modal-title"><?php echo $tableau[$i]["nom"]; ?></div>
               <div class="modal-body">
                   <?php
                   if ($tableau[$i]["texte"] != NULL OR $tableau[$i]["texte"] != "") {
                       ?>
                       <p class="descrp"><?php echo $tableau[$i]["texte"] ?></p>
                       <?php
                   }
                   ?>
                </div>
                </div>
            </div>
            <?php
           $i++;

       }
        
        

        $RqtSit="SELECT * FROM situation";
        $TabSit= mysqli_query($BDD, $RqtSit);
        $j=0;
        while ($LgnSit = mysqli_fetch_array($TabSit))
       {
           $tableauSit[$j]["id"]=$LgnSit["id_situation"];
           $tableauSit[$j]["nom"]=$LgnSit["nom_sit"];
           $tableauSit[$j]["texte"]=$LgnSit["texte_sit"];
           ?>
           <!--definition d'un modal -->
           <div style="display:none">
           <div id="Sit<?php echo  $tableauSit[$j]["id"]; ?>" class="modal-container">
               <div  class="modal-title"><?php echo $tableauSit[$j]["nom"]; ?></div>
               <div class="modal-body">
                   <?php
                   if ($tableauSit[$j]["texte"] != NULL OR $tableauSit[$j]["texte"] != "") {
                       ?>
                       <p class="descrp"><?php echo $tableauSit[$j]["texte"] ?></p>
                       <?php
                   }
                   ?>
                </div>
                </div>
            </div>
            <?php
           $j++;
       }
        ?>
        <div class="niveau">
            <!--definition du niveau 1 -->
            <div id="niveau1"  style="display:none;">
                <div class="container">
                    <div class="row about">
                        <div class="col-md-6">
                            <div class="about1">
                            <a href="deficience.php?idDef=1">
                            <img class="ImageRecherche pic1Ab"  src="images/Visuel.png" />
                                <h3><?php echo  $tableau[0]["nom"] ?></h3></a>
                                <p>
                                   <?php echo tronquer_texte($tableau[0]["texte"],60) ?>
                                   <a href="<?php echo '#'.$tableau[0]["id"].''; ?>" class="popup" name="<?php echo $tableau[0]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="deficience.php?idDef=2">
                            <img class="ImageRecherche pic2Ab" src="images/Auditif.png" />
                                <h3><?php echo $tableau[1]["nom"] ?></h3></a>
                                <p>
                                <?php echo tronquer_texte($tableau[1]["texte"],60) ?> 
                                <a href="<?php echo '#'.$tableau[1]["id"].''; ?>" class="popup" name="<?php echo $tableau[1]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
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
                                <h3><?php echo $tableau[2]["nom"] ?></h3></a>
                                <p>
                                <?php echo tronquer_texte($tableau[2]["texte"],60) ?> 
                                <a href="<?php echo '#'.$tableau[2]["id"].''; ?>" class="popup" name="<?php echo $tableau[2]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="deficience.php?idDef=4">
                            <img class="ImageRecherche pic2Ab" src="images/Mental.png" />
                                <h3><?php echo $tableau[3]["nom"] ?></h3></a>
                                <p>
                                    <?php echo tronquer_texte($tableau[3]["texte"],60) ?> 
                                    <a href="<?php echo '#'.$tableau[3]["id"].''; ?>" class="popup" name="<?php echo $tableau[3]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
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
                                <h3><?php echo $tableau[4]["nom"] ?></h3></a>
                                <p>        
                                    <?php echo tronquer_texte($tableau[4]["texte"],60) ?> 
                                    <a href="<?php echo '#'.$tableau[4]["id"].''; ?>" class="popup" name="<?php echo $tableau[4]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
             <!--definition du niveau 2 -->
            <div  id="niveau2"  style="display:none;">
                <div class="container">
                    <div class="row about">
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="situation.php?idSit=1">
                            <img class="ImageRecherche pic1Ab"  src="images\Manger.png" />
                                <h3><?php echo  $tableauSit[0]["nom"] ?></h3></a>
                                <p>
                                    <?php echo tronquer_texte($tableauSit[0]["texte"],70) ?> 
                                    <a href="<?php echo '#Sit'.$tableauSit[0]["id"].''; ?>" class="popup" name="<?php echo $tableauSit[0]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about1">
                            <a href="situation.php?idSit=2">
                            <img class="ImageRecherche pic2Ab" src="images\École travail.png" />
                                <h3><?php echo  $tableauSit[9]["nom"] ?></h3></a>
                                <p>
                                    <?php echo tronquer_texte($tableauSit[9]["texte"],60) ?>
                                    <a href="<?php echo '#Sit'.$tableauSit[9]["id"].''; ?>" class="popup" name="<?php echo $tableauSit[9]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
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
                                <h3><?php echo $tableauSit[16]["nom"] ?></h3></a>
                                <p>
                                    <?php echo tronquer_texte($tableauSit[16]["texte"],60) ?>
                                    <a href="<?php echo '#Sit'.$tableauSit[16]["id"].''; ?>" class="popup" name="<?php echo $tableauSit[16]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="about1">
                            <a href="situation.php?idSit=4">
                            <img class="ImageRecherche pic2Ab" src="images/Soins.png" />
                                <h3><?php echo  $tableauSit[22]["nom"] ?></h3></a>
                                <p>
                                    <?php echo tronquer_texte($tableauSit[22]["texte"],60) ?>
                                    <a href="<?php echo '#Sit'.$tableauSit[22]["id"].''; ?>" class="popup" name="<?php echo $tableauSit[22]["nom"]; ?>"><span class="listeBleue">[Lire la suite]</span></a>
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
        //ferme la base de données
        mysqli_close($BDD);
    
        // La fonction tronquer_texte permet de couper un texte selon le nombre de caratères souhaité
        function tronquer_texte($texte, $nbchar)
        {
        return (strlen($texte) > $nbchar ? substr(substr($texte,0,$nbchar),0,
        strrpos(substr($texte,0,$nbchar)," "))." (...)" : $texte);
        }

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
            // La fonction afficherMasquerNiveau(id) permet d'afficher ou de cacher une div spécifique selon son identifiant
            function afficherMasquerNiveau(id) 
            {
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
                else if (id=="niveau2")	
                {
    
                    document.getElementById("niveau1").style.display="none";
                    document.getElementById(id+"B").style.borderRadius= '50%';
                    document.getElementById("niveau1B").style.backgroundColor="";
                    document.getElementById("niveau1B").style.color="#00ABDC";
                }
            }


            //Cette fonction permet d'afficher la description des situations ou des déficiences
            $(document).ready(function() 
            {
            /**
            * Affichage des photos dans une Fancybox
            */
                $("a.popup").fancybox({
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
            });
</script>
</html>
