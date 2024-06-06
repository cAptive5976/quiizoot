<?php
function show_waiting($queue) {
    require('blocs/header.php'); ?>
    <h1>File d'attente du Quiz</h1>
    <div id="queue">
        <?php
        $queueHtml = '';
        // Ici on a une boucle qui affiches les utilisateurs petit a petit
        foreach ($queue as $user) {
            $queueHtml .= "<p class='joueur'><span class='prenom'>" . htmlspecialchars($user['prenom']) . "</span> " .
                          "<span class='nom'>" . htmlspecialchars($user['nom']) . "</span> " .
                          "<span class='classe'>" . htmlspecialchars($user['classe']) . "</span></p>\n";
        }
        echo $queueHtml;
        ?>
    </div>
<?php
    require('blocs/footer.php');
}
?>

