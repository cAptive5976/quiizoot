<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin'); // Si pas admin, envoit sur la page de connection admin
    exit();
}
function results_cleaner_ctrl() {
    require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
    results_cleaner($c);
    user_cleaner($c);
    header('vues/vue_accueil.php');
}