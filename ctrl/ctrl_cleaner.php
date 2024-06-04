<?php
function results_cleaner_ctrl() {
    require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
    results_cleaner($c);
    header('vues/vue_accueil.php');
}