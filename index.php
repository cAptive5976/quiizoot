<?php
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
            require('vues/quiz.php');
            break;
        case 'clean_results':
            require('ctrl/ctrl_cleaner.php');
            results_cleaner_ctrl();
            break;
        default:
            require('vues/404.php');
            break;
    }

    exit;

