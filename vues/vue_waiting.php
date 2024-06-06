<?php
function show_waiting($queue) {
    require('blocs/header.php'); ?>
    <div id="queue">
        <?php
        $queueHtml = '';
        foreach ($queue as $user) {
            $queueHtml .= "<p><span class='prenom'>" . htmlspecialchars($user['prenom']) . "</span> " .
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

