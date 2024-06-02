<?php

$id_question = $_GET['id_question']; //on récupère l'identifiant de la question depuis la route
//controleur d'affichage de la page avec les réponses à cocher
function ctrl_vue_quiz($id_question, $id_utilisateur, $reponses) {
    
    //Affichage des réponses pour l'utilisateur
    require('vues/vue_quiz.php');
    vue_reponses($id_question, $id_utilisateur, $reponses);
    
}
//controleur de l'affichage de la page de fin du quiz
function ctrl_page_fin_quiz() {
	require('vues/vue_quiz.php');
	vue_page_fin_quiz();
}

//controleur de l'affichage de la page d'attente de la question suivante 

function ctrl_vue_page_attente_question_suivante() {
	require('vues/vue_quiz.php');
	vue_page_attente_question_suivante();
}

//fonction qui, à partir du prénom, du nom et de la classe, cherche l'identifiant de l'utilisateur (élève) (fonction pas encore créée dans le CRUD). Logiquement, cette fonction sera appelée une seule fois au moment de lancer le quiz, avec le nom prénom et classe de l'élève qui s'est inscrit.

function ctrl_id_user($prenom, $nom, $classe) {
	require('crud/connection.php');
	$c = connection();
	require('crud/crud_functions.php');
	$id_utilisateur = recherche_id_utilisateur($prenom, $nom, $classe); //recherche de l'identifiant de l'utilisateur
}

//fonction qui à partir de l'identifiant de la question, si celui-ci est inférieur à 40, appelle la fonction d'affichage des réponses à cocher. Si l'id de question est supérieur à 40, affiche la page de fin de quiz. Au lancement du quiz, cette fonction serait exécutée avec l'id de question 1, puis avec un id augmenté de 1 à chaque question suivante jusqu'à la 40ème.
function ctrl_quiz($id_question) {
	
	require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
	
	$reponses = recherche_reponses($c, $id_question);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//ici il faut récupérer les réponses de l'élève quand il valide, je ne sais pas vraiment comment faire ça
		$id_utilisateur = $_POST['id_utilisateur']; //on récupère à nouveau l'id de l'utilisateur pour l'envoyer dans la base de données ensuite
		$question_suivante = $_POST['question_suivante']; //ici on récupère un paramètre 'question suivante' qui est initialisé à false quand c'est l'élève qui envoie ses réponses, et true si c'est l'administrateur qui envoie la page de la question suivante
		if ($question_suivante == false) { //comme le paramètre question suivante est false, on sait que c'est l'élève qui a envoyé ses réponses donc on envoit les réponses dans la base de données
			foreach ($reponses as $rep) {
				$rep['id_rep'] = $_POST[$rep['id_rep']]; //pas sûr qu'on puisse l'écrire comme ça, mais ici on récupère les réponses de l'élève
			}
		}	
	}
	if ($question_suivante == true) {
		if ($id_question >= 40) { //si l'admin passe à la question suivante, et que l'id de question est supérieur à 40, on affiche la fin du quiz
			ctrl_page_fin_quiz();
		} elseif ($id_question <= 40) { //si l'admin passe à la question suivante, mais que l'id de question est inférieur à 40, on affiche la question suivante
			ctrl_vue_quiz($id_question, $id_utilisateur);
	} elseif ($question_suivante == false) { //sinon, on affiche la page d'attente de la question suivante
		ctrl_vue_page_attente_question_suivante();
	}
