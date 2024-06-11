<?php

/*
Cette fonction permet charger le PDO pour la connexion a la base de données
*/
function connection() {
    require('config/config.php');

    $connex = new PDO('mysql:host=' . HOST . ';dbname=' . DB,USER , PASSWORD);
    return $connex;
}
