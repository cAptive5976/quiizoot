<?php 
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin');
    exit();
}

require('vues/blocs/header.php');

if (isset($_SESSION['green_alert'])) {
    echo '<div class="alert green_alert">' . $_SESSION['green_alert'] . '</div>';
    unset($_SESSION['green_alert']);
}

if (isset($_SESSION['red_alert'])) {
    echo '<div class="alert red_alert">' . $_SESSION['red_alert'] . '</div>';
    unset($_SESSION['red_alert']);
}


?>

<a href="index.php?route=active_quiz" class="button_login_admin_user">Créer une partie</a>
<a href="index.php?route=end_quiz" class="button_login_admin_user">Finir une partie</a>
<a href="index.php?route=waiting" class="button_login_admin_user">Accès file d'attente</a>
<a href="index.php?route=scores" class="button_login_admin_user">Accès scores</a>

<?php
require('vues/blocs/footer.php');
?>