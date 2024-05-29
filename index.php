<?php
// Affiche les erreurs
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 
ini_set('display_errors', 1);

    $route = null;
    if (isset($_GET['route'])) {
        $route = $_GET['route'];
    }

    switch ($route) {
        case null:
            require('vues/accueil.php');
            break;
        case 'console':
            require('vues/console.php');
            break;
        case 'quiz':
            require('ctrl/ctrl_quiz.php');
			ctrl_quiz();
            break;
        case 'clean_results':
            require('ctrl/ctrl_cleaner.php');
            results_cleaner_ctrl();
            break;
        case 'login':
            require('ctrl/ctrl_auth.php');
            login();
            break;
        case 'login_admin':
            require('ctrl/ctrl_auth.php');
            login_admin();
            break;
        case 'login_user':
            require('ctrl/ctrl_auth.php');
            login_user();    
        case 'menu_admin':
            require('ctrl/ctrl_menu_admin.php');
            break;
        default:
            require('vues/404.php');
            break;
    }

    exit;

