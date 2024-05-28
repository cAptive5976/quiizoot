<?php
function vue_quiz_admin() {
    require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
    $id_question = $_GET['id_question'];
    $reponses = recherche_reponses$c, $id_question);
    
    //View display
    require('vues/quiz.php');
    vue_question($id_question, $reponses);
    
}

function temps_restant() {
    $temps = 20;
    
}