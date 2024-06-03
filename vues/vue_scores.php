

<?php
include 'vues/blocs/header.php';
// Définition de la fonction display_scores
function display_scores($scores) {
    echo '<div class="container">';
    echo '<h1 class="main-title">Scores par Classe</h1>';
    
    $current_class = '';
    foreach ($scores as $score) {
        if ($current_class !== $score['classe']) {
            if ($current_class !== '') {
                echo '</tbody></table>';
            }
            $current_class = $score['classe'];
            echo '<h2 class="class-title">Classe: ' . htmlspecialchars($current_class) . '</h2>';
            echo '<table class="score-table"><thead><tr><th>Prénom</th><th>Nom</th><th>Points</th></tr></thead><tbody>';
        }
        echo '<tr>';
        echo '<td>' . htmlspecialchars($score['prenom']) . '</td>';
        echo '<td>' . htmlspecialchars($score['nom']) . '</td>';
        echo '<td>' . htmlspecialchars($score['total_points']) . '</td>';
        echo '</tr>';
    }
    if ($current_class !== '') {
        echo '</tbody></table>';
    }

    echo '</div>'; // Fermeture de la div container
    include 'vues/blocs/footer.php';
}
?>
