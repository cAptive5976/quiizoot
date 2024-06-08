<?php
require('blocs/header.php');

echo "<span id=\"welcome\">Bienvenue sur Quizoot</span>
<span id=\"welcome-text\"> ";

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        echo '<a href=\'index.php?route=menu_admin\' class=button_login_admin_user>Menu admin</a>';
    }
    if ($_SESSION['role'] == 'user') {
        echo '<a href=\'index.php?route=waiting\' class=button_login_admin_user>Retour dans la file d\'attente</a>';
    }
}
else {
    echo "Pour jouer cliquer sur \"Se connecter\"";
}

echo "</span>";

require('blocs/footer.php');
