<?php

// Fonction afficher la file d'attente et savoir quand lancer le quiz
function get_queue() {
    
    // Connexion à la base de données
    require('crud/connection.php');
    $c = connection();
    
    require('crud/crud_functions.php');
    
    // Obtention des utilisateurs dans la file d'attente
    $queue = get_users($c);
    
    // Vérification de l'état actuel du quiz
    $isactive = get_isactive($c);
    
    require('vues/vue_waiting.php');
    
    // Affichage de la file d'attente et de l'état du quiz
    show_waiting($queue, $isactive);
}

?>
