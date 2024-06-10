<?php

session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'user' && $_SESSION['role'] !== 'admin')) {
    header('Location: index.php?route=login'); // Si pas connecté, envoit sur la page de connexion
    exit();
}
function show_waiting($queue, $isactive) {
    require('blocs/header.php'); ?>
    <h1>File d'attente du Quiz</h1>
    <?php
    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'admin') {
     echo '<a href=\'index.php?route=menu_admin\' class=button_login_admin_user>Retour sur le menu admin</a>';
    } elseif ($isactive == 1) {
        echo '<a href=\'index.php?route=quiz&id_question=1\' class=button_login_admin_user>Démarrer le Quiz</a>';
    }
    ?>
    <div id="queue">
        <?php
        $queueHtml = '';
        // Ici on a une boucle qui affiches les utilisateurs petit a petit
        foreach ($queue as $user) {
            $queueHtml .= "<p class='joueur'><span class='prenom'>" . htmlspecialchars($user['prenom']) . "</span> " .
                          "<span class='nom'>" . htmlspecialchars($user['nom']) . "</span> " .
                          "<span class='classe'>" . htmlspecialchars($user['classe']) . "</span></p>";
        }
        echo $queueHtml;
        ?>
    </div>
<?php
    require('blocs/footer.php');
}
?>
