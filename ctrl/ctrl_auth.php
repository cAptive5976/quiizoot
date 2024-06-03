<?php
session_start();

function login() {
    require('vues/login_admin_user.php');
}

function login_user (){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $classe = $_POST['classe'];

        require('crud/connection.php');
	    $c = connection();
	    require('crud/crud_functions.php');
        login_user_crud($c, $prenom, $nom, $classe);

        header('Location: index.php?route=waiting');
    } else {
        require('vues/vues_user/auth_user.php');
    }
}
function login_admin() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Pour l'exemple, nous utilisons des valeurs en dur
        if ($username == 'admin' && $password == 'password') {
            $_SESSION['admin'] = true;
            header('Location: index.php?route=menu_admin');
            exit;
        } else {
            header('Location: index.php?route=login&error=1');
            exit;
        }
    } else {
        require('vues/vues_admin/auth_admin.php');
    }
}