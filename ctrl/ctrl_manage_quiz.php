<?php

session_start(); // Démarre la session PHP

// Vérifie si l'utilisateur a le rôle 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin'); // Si pas admin, redirige vers la page de connexion admin
    exit();
}

function active_quiz() {
    require('crud/connection.php'); // Inclut le fichier de connexion à la base de données
    $c = connection(); // Établit la connexion à la base de données
    require('crud/crud_functions.php'); // Inclut les fonctions CRUD
    $isactive = get_isactive($c); // Vérifie si le quiz est déjà actif

    if ($isactive == 0) {
        set_active($c); // Active le quiz si inactif
        $_SESSION['green_alert'] = "Le quiz est maintenant actif."; // Message de succès
    } else {
        $_SESSION['red_alert'] = "Le quiz est déjà actif."; // Message d'erreur
    }
    header('Location: index.php?route=menu_admin'); // Redirige vers le menu admin
}

function end_quiz() {
    require('crud/connection.php'); // Inclut le fichier de connexion à la base de données
    $c = connection(); // Établit la connexion à la base de données
    require('crud/crud_functions.php'); // Inclut les fonctions CRUD
    $isactive = get_isactive($c); // Vérifie si le quiz est déjà inactif

    if ($isactive == 1) {
        set_inactive($c); // Désactive le quiz si actif
        $_SESSION['green_alert'] = "Le quiz est maintenant inactif."; // Message de succès
    } else {
        $_SESSION['red_alert'] = "Le quiz est déjà inactif."; // Message d'erreur
    }
    header('Location: index.php?route=menu_admin'); // Redirige vers le menu admin
}