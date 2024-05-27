<?php
    $route = null;
    if (isset($_GET['route'])) {
        $rte = $_GET['route'];
    }

    switch ($rte) {
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
            break;
        default:
            require('vues/404.php');
            break;
    }

    exit;

