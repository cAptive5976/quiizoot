<?php 
// Ici on démare une session, si la variable _SESSION['role'] n'est pas admin alors la personne est renvoyé a la page de connexion admin
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin');
    exit();
}

require('vues/blocs/header.php');

// Affiche une alerte si une session 'red_alert' ou 'green_alert' est définie.
// 'red_alert' pour les messages d'erreur.
// 'green_alert' pour les messages de succès.
if (isset($_SESSION['green_alert'])) {
    echo '<div class="alert green_alert">' . $_SESSION['green_alert'] . '</div>';
    unset($_SESSION['green_alert']);
}

if (isset($_SESSION['red_alert'])) {
    echo '<div class="alert red_alert">' . $_SESSION['red_alert'] . '</div>';
    unset($_SESSION['red_alert']);
}

// Ici on affiche les 4 bouttons du menu admin, chacun associé a une route
echo '
<a href="index.php?route=active_quiz" class="button_login_admin_user">Créer une partie</a>
<a href="index.php?route=end_quiz" class="button_login_admin_user">Finir une partie</a>
<a href="index.php?route=waiting" class="button_login_admin_user">Accès file d\'attente</a>
<a href="index.php?route=scores" class="button_login_admin_user">Accès scores</a>
';

require('vues/blocs/footer.php');
?>