<?php
/*
    $servername = getenv('IP');
    $username = "projet6";
    $password = "PS9976ct";
    $database = "projet6";
    $dbport = 3306;
*/

    $servername = "localhost";
    $username = "fractures-datac";
    $password = "Xd48KHqcq46dJ2ve";
    $database = "fractures-datac";
    //$dbport = 3306;

    // Create connection
    //$BDD = new mysqli($servername, $username, $password, $database, $dbport);
    $BDD = new mysqli($servername, $username, $password, $database);

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
