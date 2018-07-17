<?php
    if(empty($_SESSION['connecte'])){
        session_start();
    }
    else {
        session_destroy();
        session_start();
    }
?>
<p>
    <?php
    //test : utilisateur pas encore connecté ?
    if (empty($_SESSION['connecte']) && empty($_SESSION['idpers']))
    {
        ?>
        <a href="gestion/page_connexion.php" class="btn btn-primary btn-connexion">Connexion</a>
        <?php
    }

    else
    {

        ?>
        <a href="./gestion/accueil_gestionnaire.php" class="btn btn-primary btn-connexion">Déjà connecté</a>
        <?php
    }
    ?>
</p>