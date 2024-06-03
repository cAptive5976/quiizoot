<?php

function get_scores_by_class() {
    require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
    score_classe($c);
    require('vues/vue_scores.php');
    $scores = score_classe($c); // Utilisez la fonction score_classe du fichier crud_functions.php
    display_scores($scores);
}

