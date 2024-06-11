<?php
// Affiche les erreurs
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 
ini_set('display_errors', 1);

    $route = null; // Valeur par défaut de la route, redirige vers la page principale avec le case null
    if (isset($_GET['route'])) {
        $route = $_GET['route'];
    }

    switch ($route) {
        case null:
            require('vues/vue_accueil.php');
            break;

        // Partie de connection

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
            break;

        // Accès interdit users
        case 'menu_admin':
            require('vues/vues_admin/menu_admin.php');
            break;
        case 'scores' :
            require('ctrl/ctrl_scores.php');
            get_scores_by_class();
            break;
        case 'clean_results':
            require('ctrl/ctrl_cleaner.php'); // Inclut le contrôleur de nettoyage des résultats
            results_cleaner_ctrl(); // Appelle la fonction pour nettoyer les résultats
            break;
        case 'active_quiz':
            require('ctrl/ctrl_manage_quiz.php'); // Inclut le contrôleur de gestion du quiz
            active_quiz(); // Appelle la fonction pour activer le quiz
            break;
        case 'end_quiz':
            require('ctrl/ctrl_manage_quiz.php'); // Inclut le contrôleur de gestion du quiz
            end_quiz(); // Appelle la fonction pour désactiver le quiz
            break;
        // Accès seulement après connection
        case 'waiting':
            require('ctrl/ctrl_waiting.php');
            get_queue();
            break;
        case 'quiz':
            require('ctrl/ctrl_quiz.php');
            ctrl_quiz();
            break;
        case 'logout':
            require('ctrl/ctrl_logout.php');
            break;

        // Autres
        case 'about':
            require('vues/vue_about.php');
            break;
        case 'error':
            require('vues/vue_error.php');
            break;
    }

    exit;