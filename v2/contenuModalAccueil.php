<?php
// Connexion à la base de données
require("connect.php");
mysqli_set_charset($BDD, "utf8");
// Recherche et affichage (hyperlien) de toutes les déficiences
$RqtDef = "SELECT * FROM deficience";
$TabDef = mysqli_query($BDD, $RqtDef);
$LgnDef = mysqli_fetch_array($TabDef)
?>

<div class="modal-container">
    <div class="modal-title"><?php echo $LgnDef["nom_def"]; ?></div>
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