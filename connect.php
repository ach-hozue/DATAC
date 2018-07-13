<?php
/*
    $servername = getenv('IP');
    $username = "projet6";
    $password = "PS9976ct";
    $database = "projet6";
    $dbport = 3306;
*/

    $servername = "localhost";
    $username = "agautheron"; // mettre ici l'utilisateur de la base de données (root par exemple)
    $password = "agautheron"; // mettre ici le mot de passe
    $database = "fractures-datac"; // mettre ici le nom de la base de données
    $dbport = 3306;

    // Create connection
    $BDD = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($BDD->connect_error) {
        die("Connection failed: " . $BDD->connect_error);
    }
    /*$SERVEUR = "localhost";
    $LOGIN = "root";
    $MDP = "";
    $MABASE = "projet6";
    $BDD = mysqli_connect($SERVEUR,$LOGIN,$MDP,$MABASE);*/
?>
