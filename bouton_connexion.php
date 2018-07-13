<div class="bouton_connexion">

    <script>
        if(screen.width<767){
            <?php
            if(empty($_SESSION['connecte'])){
                session_destroy();
                session_start();
            }
            ?>
        }else{
            <?php
            if(empty($_SESSION['connecte'])){
                session_start();
            }
            ?>
        }
    </script>

    <?php
    //test : utilisateur pas encore connecté ?
    if (empty($_SESSION['connecte']) && empty($_SESSION['idpers']))
    {
        ?>
        <a href="gestion/page_connexion.php" class="btn btn-primary">Connexion</a>
        <?php
    }

    else
    {

        ?>
        <a href="./gestion/accueil_gestionnaire.php" class="btn btn-primary">Déjà connecté</a>
        <?php
    }
    ?>
</div>