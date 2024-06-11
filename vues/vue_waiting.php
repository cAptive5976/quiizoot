<?php

session_start();

// Vérification du rôle de l'utilisateur
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'user' && $_SESSION['role'] !== 'admin')) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: index.php?route=login');
    exit();
}

// Fonction pour afficher la file d'attente
function show_waiting($queue, $isactive) {

    require('blocs/header.php'); ?>
    <h1>File d'attente du Quiz</h1>
    
    <?php
    // Affichage du bouton de retour ou de démarrage du quiz selon le rôle et l'état
    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'admin') {
        echo '<a href=\'index.php?route=menu_admin\' class=button_login_admin_user>Retour sur le menu admin</a>';
    } elseif ($isactive == 1) {
        echo '<a href=\'index.php?route=quiz&id_question=1\' class=button_login_admin_user>Démarrer le Quiz</a>';
    }
    ?>
    <div id="queue">
        <?php
        $queueHtml = '';
        // Boucle pour afficher les utilisateurs petit a petit dans la file d'attente
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
