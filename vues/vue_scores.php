

<?php
include 'vues/blocs/header.php';
// Définition de la fonction display_scores
function display_scores($scores) {
    usort($scores, function($a, $b) {
        return $b['total_points'] - $a['total_points'];
    });
    $top_three = array_slice($scores, 0, 3);
    
    echo '<div class="container">';
    echo '<h1 class="main-title">Podium des Scores</h1>';
    
    echo '<div class="podium">';
    if (!empty($top_three)) {
        
        if (isset($top_three[0])) {
            echo '<div class="podium-item first">';
            echo '<span class="podium-rank">1</span>';
            echo '<span class="podium-name">' . htmlspecialchars($top_three[0]['prenom'] . ' ' . $top_three[0]['nom']) . '</span>';
            echo '<span class="podium-score">' . htmlspecialchars($top_three[0]['total_points']) . ' points</span>';
            echo '</div>';
        }
        if (isset($top_three[1])) {
            echo '<div class="podium-item second">';
            echo '<span class="podium-rank">2</span>';
            echo '<span class="podium-name">' . htmlspecialchars($top_three[1]['prenom'] . ' ' . $top_three[1]['nom']) . '</span>';
            echo '<span class="podium-score">' . htmlspecialchars($top_three[1]['total_points']) . ' points</span>';
            echo '</div>';
        }
        if (isset($top_three[2])) {
            echo '<div class="podium-item third">';
            echo '<span class="podium-rank">3</span>';
            echo '<span class="podium-name">' . htmlspecialchars($top_three[2]['prenom'] . ' ' . $top_three[2]['nom']) . '</span>';
            echo '<span class="podium-score">' . htmlspecialchars($top_three[2]['total_points']) . ' points</span>';
            echo '</div>';
        }
    }
    echo '</div>';
    
    echo '<a href="index.php?route=menu_admin" class="bouton_scores">Fermer Quizz</a>';
    echo '</div>'; // Fermeture de la div container
}
?>
