<?php

function connection() {
    require('config/config.php');

    $connex = new PDO('mysql:host=' . HOST . ';dbname=' . DB,USER , PASSWORD);
    return $connex;
}


