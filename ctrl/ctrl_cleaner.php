<?php

session_start(); // Démarre la session PHP

// Vérifie si l'utilisateur a le rôle 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin'); // Si pas admin, redirige vers la page de connexion admin
    exit();
}

function results_cleaner_ctrl() {
    require('crud/connection.php'); // Inclut le fichier de connexion à la base de données
    $c = connection(); // Établit la connexion à la base de données
    require('crud/crud_functions.php'); // Inclut les fonctions CRUD
    results_cleaner($c); // Appelle la fonction pour nettoyer les résultats
    user_cleaner($c); // Appelle la fonction pour nettoyer les utilisateurs
    header('Location: index.php?route=menu_admin'); // Redirige vers le menu admin
}