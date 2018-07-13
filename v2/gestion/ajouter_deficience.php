<!doctype html>
<?php
session_start();
// mise en place d'une sécurité d'accès des pages
// il faut mettre le session_start sinon le empty vérifie que la variable n'exsite pas et
//  sans le session_strart la variable n'exsite pas et donc on est tout le temps dans le if
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
    <title>DATÀC – Ajouter une déficience</title>
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

    <!--bannière grise avec formulaire d'ajout-->
    <div class="row rForm">
        <div class="col-sm-offset-1 col-sm-10">
            <form method = "POST" id="formID">
                <div class="form-group">
                    <label for="name">Écrivez la déficience que vous souhaitez ajouter :</label>
                    <input type="text" class="form-control" id="name" name="nom_def" required >
                </div>
                <div class="form-group">
                    <label for="description">Écrivez une description de la déficience :</label>
                    <textarea class="form-control" rows = 8 id="description" name="texte_def" required ></textarea>
                </div>
                <button class="btn btn-primary" type="submit" name="_ajouter">Ajouter</button>
            </form>
        </div>
    </div>
    <!--remplace le required qui ne fonctionne pas sur safari-->
<script>
    var form = document.getElementById('formID'); // form has to have ID: <form id="formID">
        form.noValidate = true;
        form.addEventListener('submit', function(event) { // listen for form submitting
        if (!event.target.checkValidity()) {
        event.preventDefault(); // dismiss the default functionality
        alert('Veuillez remplir tous les champs du formulaire'); // error message
        }
        }, false);
</script>

    <footer>
        <p>&copy; DATÀC – Tous droits réservés</p>
    </footer>
</div>
<?php

if(!empty($_POST['nom_def']) && !empty($_POST['texte_def']))
{
    $nom_def = $_POST['nom_def'];
    $texte_def = $_POST['texte_def'];

if($BDD)
{
    //ajout de la déficience
    $ReqAjDef = "INSERT INTO deficience VALUES ('','$nom_def', '$texte_def')";

if(mysqli_query($BDD, $ReqAjDef))
{
    ?>
    <script>
        alert("<?php echo htmlspecialchars('Votre déficience a bien été ajoutée', ENT_QUOTES); ?>");
        window.location.href = 'accueil_gestionnaire.php';
    </script>
<?php
}
}
}
}
?>
</body>
</html>
