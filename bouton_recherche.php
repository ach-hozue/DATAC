
   
        <!-- Envoi du texte rentré par l'utilisateur pour la recherche -->
    <form class="bouton_recherche" action="recherche.php" method="POST">
        <div class="form-group"> <!--récupère la recherche de l'utilisateur-->
            <input class="recherchePetit" autocomplete="on" type="text" placeholder="Chercher un dispositif..." name="recherche" value="<?php echo (isset($_POST["recherche"]))?$_POST["recherche"]:""; ?>" />
            <button class="btn btn-primary btnGrand"><span class="glyphicon glyphicon-search"></span></button>
        </div>
    </form>
