<!DOCTYPE html>
<?php
require("../connect.php");
mysqli_set_charset($BDD, "utf8");
//recupération du login de l'utilisateur connecté
$marequete = "SELECT * FROM personne WHERE id_pers = ".$_SESSION['idpers'];
$monrs = mysqli_query($BDD, $marequete);
$tuple = mysqli_fetch_array($monrs)['login'];
?>
<br>
<!-- barre de menu -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid navbarColor">
        <ul class="nav navbar-nav">
            <!-- Home -->
            <li class="dropdown"><a href="accueil_gestionnaire.php">Home</a></li>
            <!-- Ajouter -->
            <li class="dropdown"><a class="dropdown-toggle navbarTxt" data-toggle="dropdown" href="#">Ajouter <span class="caret"></span></a>
                <!-- Choix des ajouts -->
                <ul class="dropdown-menu">
                    <li><a href="ajouter_deficience.php">une deficience</a></li>
                    <li><a href="ajouter_categorie.php">une categorie</a></li>
                    <li><a href="ajouter_dispositif.php">un dispositif</a></li>
                </ul>
            </li>
            <!-- Supprimer -->
            <li class="dropdown"><a class="dropdown-toggle navbarTxt" data-toggle="dropdown" href="#">Supprimer <span class="caret"></span></a>
                <!-- Choix des suppressions -->
                <ul class="dropdown-menu">
                    <li><a href="supprimer_categorie.php">une categorie</a></li>
                    <li><a href="supprimer_dispositif.php">un dispositif</a></li>
                </ul>
            </li>
            <!-- Déplacement -->
            <li class="dropdown"><a class="dropdown-toggle navbarTxt" data-toggle="dropdown" href="#">Deplacer <span class="caret"></span></a>
                <!-- Choix des déplacements -->
                <ul class="dropdown-menu">
                    <li><a href="deplacer_categorie.php">une categorie</a></li>
                    <li><a href="deplacer_dispositif.php">un dispositif</a></li>
                </ul>
            </li>
            <!-- Modification -->
            <li class="dropdown"><a class="dropdown-toggle navbarTxt" data-toggle="dropdown" href="#">Modifier <span class="caret"></span></a>
                <!-- Choix des modifications -->
                <ul class="dropdown-menu">
                    <li><a href="modifier_deficience.php">une deficience</a></li>
                    <li><a href="modifier_categorie.php">une categorie</a></li>
                    <li><a href="modifier_dispositif.php">un dispositif</a></li>
                </ul>
            </li>
            <!-- Dupliquer un dispositif -->
            <li class="dropdown"><a href="copier_dispositif.php">Dupliquer un dispositif</a></li>

            <?php
            // Si on est administrateur on peut gérer les personnes
            if ($_SESSION['statut'] == "administrateur")
            {
                ?>
                <!-- Gérer les personnes -->
                <li class="dropdown"><a class="dropdown-toggle navbarTxt" data-toggle="dropdown" href="#">Les personnes <span class="caret"></span></a>
                    <!-- ajout ou suppression -->
                    <ul class="dropdown-menu">
                        <li><a href="ajouter_gestionnaire.php">Ajouter</a></li>
                        <li><a href="supprimer_gestionnaire.php">Supprimer</a></li>
                    </ul>
                </li>

                <?php
            }else{
                ?>
                <!-- Gérer les personnes bloqué -->
                <li class="dropdown"><a class="dropdown-toggle navbarTxt" data-toggle="dropdown" href="#">Les personnes <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="disabled persDisabled" title="Vous n'êtes pas administrateur"><a>Ajouter</a></li>
                        <li class="disabled persDisabled" title="Vous n'êtes pas administrateur"><a>Supprimer</a></li>
                    </ul>
                </li>

                <?php
            }
            ?>
            <!-- Modification du compte -->
            <li class="dropdown"><a href="form.php">Modifier mon compte</a></li>

        </ul>
    </div>
</nav>


