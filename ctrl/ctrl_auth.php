<?php
session_start();

function login() {
    require('vues/login_admin_user.php');
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
    }
    
    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
        header('Location: index.php?route=menu_admin');
        exit;
    } else {
        require('vues/auth_admin.php');
    }
}