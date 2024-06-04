<?php
session_start();

function login() {
    require('vues/vue_login.php');
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
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];

        require('crud/connection.php');
        $c = connection();
        require('crud/crud_functions.php');
        $login = login_admin_crud($c, $prenom, $nom);

        if ($login && $password === $login['password']) {
            header('Location: index.php?route=menu_admin');
            exit;
        } else {
            echo "<script>alert('Login ou mot de passe incorrect');</script>";
            echo "<script>window.location.href = 'index.php?route=login_admin';</script>";
            exit;
        }
    } else {
        require('vues/vues_admin/auth_admin.php');
    }
}
