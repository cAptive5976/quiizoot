<?php 
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin'); // Si pas connecter, envoit sur la page de connection
    exit();
}

echo "<a href='#' id='create-game-btn' class='button_login_admin_user'>Créer Partie</a>";

echo "<a href='index.php?route=waiting' class=button_login_admin_user>Accès file d'attente</a>";

echo "<a href='index.php?route=scores' class=button_login_admin_user>Accès scores</a>";

?>