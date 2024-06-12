<?php
session_start();


// Fonction pour afficher la page de login.
 
function login() {
    require('vues/vue_login.php');
}


// Cette fonction vérifie si une requête POST a été envoyée. Si oui, elle récupère les données
// de login, vérifie si l'utilisateur existe déjà dans la base de données et, si c'est le cas,
// crée une session pour l'utilisateur. Sinon, elle crée un nouvel utilisateur dans la base
// de données, puis crée une session pour cet utilisateur.
 
function login_user() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $classe = $_POST['classe'];

        require('crud/connection.php');
        $c = connection();
        require('crud/crud_functions.php');

        $user = find_user_by_name($c, $prenom, $nom, $classe); // On vérifie si l'utilisateur existe déjà

        if ($user) {
            $_SESSION['user'] = $user['prenom'] . ' ' . $user['nom'] . ' ' . $user['classe'];
            $_SESSION['role'] = 'user';
            header('Location: index.php?route=waiting');
            exit;
        } else {
            login_user_crud($c, $prenom, $nom, $classe);
            $_SESSION['user'] = $prenom . ' ' . $nom . ' ' . $classe;
            $_SESSION['role'] = 'user';
            header('Location: index.php?route=waiting');
            exit;
        }
    } else {
        require('vues/vues_user/auth_user.php');
    }
}


// Cette fonction vérifie si une requête POST a été envoyée. Si oui, elle récupère les données
// de login, vérifie si l'administrateur existe et si le mot de passe est correct. Si c'est le
// cas, elle crée une session pour l'administrateur. Sinon, elle renvoie une erreur de login.


function login_admin() {
    // Vérifie si la méthode de la requête est POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupère les données du formulaire
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];

        // Inclut le fichier de connexion à la base de données
        require('crud/connection.php');
        // Établit la connexion à la base de données
        $c = connection();
        // Inclut les fonctions CRUD nécessaires
        require('crud/crud_functions.php');
        // Tente de récupérer les informations de l'admin via les fonctions CRUD
        $admin = login_admin_crud($c, $prenom, $nom);

        // Vérifie si l'admin existe et si le mot de passe est correct
        if ($admin && $password === $admin['password']) {
            // Initialise les variables de session pour l'admin connecté
            $_SESSION['admin'] = true;
            $_SESSION['user'] = $admin['prenom'] . ' ' . $admin['nom'];
            $_SESSION['role'] = 'admin';
            $_SESSION['green_alert'] = "Bienvenue " . $admin['prenom'];
            // Redirige l'admin vers la page du menu admin
            header('Location: index.php?route=menu_admin');
            exit;
        } else {
            // En cas d'échec de connexion, met à jour l'alerte de session
            $_SESSION['red_alert'] = "Login ou mot de passe incorrect";
            // Redirige vers la page de login admin
            header('Location: index.php?route=login_admin');
            exit;
        }
    } else {
        // Si la méthode de la requête n'est pas POST, affiche le formulaire de login admin
        require('vues/vues_admin/auth_admin.php');
    }
}
