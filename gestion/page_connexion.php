<!doctype html>

<html>
<head>
    <title>DATÀC – Connexion</title>
    <meta charset = "utf-8" />
    <link rel = "stylesheet" href = ".././bootstrap/css/bootstrap.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "msf_gestionnaire.css" id="css"/>
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<body>
<!--container : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...)-->
<div class="container" id="c1">
    <div class="row"></div>
    <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-3 col-xs-6" id="zoneLogin">
        <?php
        session_start();
        $connexion = false;
        ?>

        <!-- logo DATAC -->
        <div class="row">
            <a class="col-xs-push-2 col-xs-8" href="../accueil.php">
                <img id="imgDatac" class="img-responsive" src="../images/logo_datac.svg"/>
                <img id="imgDatacContrast" class="img-responsive" src="../images/logo_datac_contrast.svg"/>
            </a>
        </div>

        <!-- formulaire -->
        <div class="row">

            <form method="post">

                <!-- Text input-->
                <div class="form-group">
                    <label class="control-label" for="textinput">Login</label>
                    <input id="login" name="login" class="form-control input-xs" type="text">
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="control-label" for="passwordinput">Mot de passe</label>
                    <input id="mdp" name="mdp" class="form-control input-xs" type="password">
                </div>

                <a class="col-xs-4 btn-block" id="mdpOublie" href = "mailto:marie.guiraute@ensc.fr;marwa.mathlouthi@ensc.fr;emilie.roger@ensc.fr;alexia.tartas@ensc.fr?subject=DATÀC – Mot de passe oublié">Mot de passe oublié ?</a>


                <!-- Button -->
                <div class="form-group">
                    <div class="pull-right">
                        <button id="btn_envoi" name="btn_envoi" class="btn btn-primary"><span class="glyphicon glyphicon-log-in pull-right iconeConnect"></span>Se connecter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <?php
            //Si le login et/ou mot de passe est incorrect on n'affiche un message d'erreur
            if (array_key_exists('login', $_POST))
            {
                ?>
                <script>
                    $("div.form-group").addClass("has-error");
                </script>
                <p class = "erreur">
                    Votre login ou votre mot de passe n'est pas correct.
                    <br/>
                    Veuillez recommencer votre saisie pour vous connecter.
                </p>
                <?php
            }
            ?>
        </div>

        <?php
        if (array_key_exists('login', $_POST))
        {
            // condition qui vérifie que le login a bien été rentré donc la personne a tenté une connexion
            require ("../connect.php");
            mysqli_set_charset($BDD, "utf8");

            // utilisation de la seconde base juste pour la connexion
            $monRS = "SELECT * FROM personne WHERE login = '" . $_POST['login'] . "' and mdp = '" . $_POST['mdp'] . "'";
            $marequete = mysqli_query($BDD, $monRS);

            if (empty($connexion)) { $connexion = 1; }
            else {$connexion++;}

            if ($connexion == 3)
            {
                header('Location: page_attente.php');
                exit();
            }

            //test pour les mutliples tentatives de connexion
            while ($tuple = mysqli_fetch_array($marequete))
            {
                $_SESSION['idpers'] = $tuple['id_pers'];
                $_SESSION['statut'] = $tuple['statut'];
                $_SESSION['connecte'] = true;

                header('Location: accueil_gestionnaire.php');
                exit();
            }
        }
        ?>
    </div>
</div>
<!-- definition de la flèche précédent (retour à accueil) -->
<a class="pagePreced" href="../accueil.php"><img class="logoRetour" src="../images/retour_fleche.png"> </a>

<!--Changement de feuille de style-->
<a class="btn btn-primary changeContraste" href="#" onclick="changeContrast()">Contraste élevé</a>
<script>
    function changeContrast() {
        console.log($('#css').attr('href'));
        if($('#css').attr('href') == 'msf_gestionnaire.css') {
            $('#css').replaceWith('<link id=css rel=stylesheet href=msf_gestionnaire_contrast.css>');
            $('.changeContraste').text('Contraste standard');
        }else{
            $('#css').replaceWith('<link id=css rel=stylesheet href=msf_gestionnaire.css>');
            $('.changeContraste').text('Contraste élevé');
        }
    }
</script>
</body>
</html>