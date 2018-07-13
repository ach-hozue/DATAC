<?php
require("../connect.php");
mysqli_set_charset($BDD, "utf8");
//recupération du login de l'utilisateur connecté
$marequete = "SELECT * FROM personne WHERE id_pers = ".$_SESSION['idpers'];
$monrs = mysqli_query($BDD, $marequete);
$tuple = mysqli_fetch_array($monrs)['login'];
?>

<div class="tailleNormal">
    <a class="col-sm-offset-1 col-sm-3" target="_blank" href="https://fracturesnumeriques.fr/">
        <img class="img-responsive" src="../images/fractures_logo.png"/>
    </a>
    <a class="col-sm-3" href="../accueil.php">
        <img class="img-responsive" src="../images/datac_logo.png"/>
    </a>
    <div class="col-sm-4">
        <div class="row rightHead">
            Connecté en tant que : <b><?php echo $tuple; ?></b>
        </div>
        <div class="row rightHead">
            <a href = "logout.php">Déconnexion </a>
        </div>
        <div class="row rightHead">
            <a href = "../accueil.php">Retour au site DATÀC</a>
        </div>
    </div>
</div>

<div class="petiteTaille">
    <div class="row">
        <a class="col-xs-offset-1 col-xs-5" target="_blank" href="https://fracturesnumeriques.fr/">
            <img class="img-responsive" src="../images/fractures_logo.png"/>
        </a>
        <div class="col-xs-4 rightHeadPetit">
            Connecté en tant que : <?php echo $tuple; ?>
        </div>

    </div>
    <div class="row">
        <a  class="col-xs-offset-1 col-xs-5" href="../accueil.php">
            <img class="img-responsive" src="../images/datac_logo.png"/>
        </a>
        <div class=" col-xs-4 rightHeadPetit">
            <br>
            <a  href = "logout.php">Déconnexion </a>
            <br><br><br>
            <a  href = "../accueil.php">Retour au site DATÀC</a>
        </div>
    </div>
</div>