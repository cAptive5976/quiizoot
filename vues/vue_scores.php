<?php

session_start();

// Vérification du rôle de l'utilisateur (doit être admin)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Redirection vers la page de connexion admin si l'utilisateur n'est pas admin
    header('Location: index.php?route=login_admin');
    exit();
}

include 'vues/blocs/header.php';

// Définition de la fonction pour afficher les scores
function display_scores($scores) {
    // Trier les scores pour obtenir les top 3
    usort($scores, function($a, $b) {
        return $b['total_points'] - $a['total_points'];
    });
    $top_three = array_slice($scores, 0, 3);

    // Calculer la meilleure classe et le nombre total de points de la classe
    $classe_points = [];
    foreach ($scores as $score) {
        if (!isset($classe_points[$score['classe']])) {
            $classe_points[$score['classe']] = 0;
        }
        $classe_points[$score['classe']] += $score['total_points'];
    }
    arsort($classe_points);
    $best_classe = key($classe_points);
    $best_classe_points = reset($classe_points);

    // Affichage du podium des scores
    echo '<div class="container-encadre">';
    echo '<h1 class="main-title">Podium des Scores</h1>';
    echo '<div class="podium">';

    // Affichage des top 3 scores
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
    echo '</div>'; // Fermeture de la div podium

    // Affichage de la meilleure classe avec le nombre de points
    echo '<div class="best-classe">';
    echo '<h2>Meilleure Classe: ' . htmlspecialchars($best_classe) . '</h2>';
    echo '<p>Total Points: ' . htmlspecialchars($best_classe_points) . '</p>';
    echo '</div>';

    // Génère un lien pour fermer le quiz et nettoyer les résultats
    echo '<a href="index.php?route=clean_results" class="bouton_scores">Fermer Quizz</a>';
    echo '</div>'; // Fermeture de la div container

    include 'vues/blocs/footer.php';
}
?>

