<?php

$id_question = $_GET['id_question'];

function ctrl_vue_quiz($id_question, $id_utilisateur) {
    require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
    
    $reponses = recherche_reponses($c, $id_question);
    
    //Affichage des réponses pour l'utilisateur
    require('vues/vue_quiz.php');
    vue_reponses($id_question, $id_utilisateur, $reponses);
    
}

function ctrl_page_fin_quiz() {
	require('vues/vue_quiz.php');
	vue_page_fin_quiz();
}

function ctrl_quiz($id_question, $prenom, $nom, $classe) {
	require('crud/connection.php');
   $c = connection();
   require('crud/crud_functions.php');
	$id_utilisateur = recherche_id_utilisateur($prenom, $nom, $classe);
	if ($id_question >= 40) {
		ctrl_page_fin_quiz();
	} else {
		ctrl_vue_quiz($id_question, $id_utilisateur);
	}
}
