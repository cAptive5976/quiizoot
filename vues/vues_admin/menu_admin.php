<?php 
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin'); // Redirect if not logged in as admin
    exit();
}

require('vues/blocs/header.php');
?>

<a href="#" id="create-game-btn" class="button_login_admin_user">Créer Partie</a>
<a href="index.php?route=waiting" class="button_login_admin_user">Accès file d'attente</a>
<a href="index.php?route=scores" class="button_login_admin_user">Accès scores</a>

<?php
require('vues/blocs/footer.php');
?>