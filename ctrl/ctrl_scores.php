<?php

// Fonction pour obtenir et afficher les scores par classe
function get_scores_by_class() {

    // Connexion à la base de données
    require('crud/connection.php');
    $c = connection();
    
    require('crud/crud_functions.php');
    require('vues/vue_scores.php');

    // Obtention des scores de la classe
    $scores = score_classe($c);

    // Affichage des scores
    display_scores($scores);
}

?>
