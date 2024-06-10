<?php
session_start();

function login() {
    require('vues/vue_login.php');
}

function login_user() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $classe = $_POST['classe'];

        require('crud/connection.php');
        $c = connection();
        require('crud/crud_functions.php');

        $user = find_user_by_name($c, $prenom, $nom, $classe); // On vérifie si l'utilisateur existe déja, car pas besoin de créé deux fois le même

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
function login_admin() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];

        require('crud/connection.php');
        $c = connection();
        require('crud/crud_functions.php');
        $admin = login_admin_crud($c, $prenom, $nom);

        if ($admin && $password === $admin['password']) {
            $_SESSION['admin'] = true;
            $_SESSION['user'] = $admin['prenom'] . ' ' . $admin['nom'];
            $_SESSION['role'] = 'admin';
            $_SESSION['green_alert'] = "Bienvenue " . $admin['prenom'];
            header('Location: index.php?route=menu_admin');
            exit;
        } else {
            $_SESSION['red_alert'] = "Login ou mot de passe incorrect";
            header('Location: index.php?route=login_admin');
            exit;
        }
    } else {
        require('vues/vues_admin/auth_admin.php');
    }
}
