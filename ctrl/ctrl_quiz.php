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

//fonction pour trouver l'id utilisateur à partir du nom, du prénom et de la classe de l'élève :

//function recherche_id_utilisateur($connex, $prenom, $nom, $classe) {
//
//		$req = "SELECT u.id FROM users u WHERE u.prenom = :prenom AND u.nom = :nom AND u.classe = :classe";
//    $res = $connex->prepare($req);
//    $res->bindParam(':prenom', $prenom, PDO::PARAM_STR);
//    $res->bindParam(':nom', $nom, PDO::PARAM_STR);
//		$res->bindParam(':classe', $classe, PDO::PARAM_STR);
//    $res->execute();
//    $id_utilisateur = $res->fetchAll(PDO::FETCH_ASSOC);
//    $res->closeCursor();
//		return $id_utilisateur;
//}

//fonction crud pour afficher toutes les réponses à cocher selon l'id de question

//function recherche_reponses($connex, $id_question) {
//		$req = "SELECT id, enonce_reponse FROM reponse WHERE question_id = :id;
//		$res = $connex->prepare($req);
//		$res->bindParam(':id', $id_question, PDO::PARAM_STR);
//    $res->execute();
//    $reponses = $res->fetchAll(PDO::FETCH_ASSOC);
//    $res->closeCursor();
//		return $reponses;
//}

//fonction crud pour afficher l'énoncé de la question a partir de son id

//function recherche_question($connex, $id_question) {
//		$req = "SELECT id, enonce FROM question WHERE id = :id;
//		$res = $connex->prepare($req);
//		$res->bindParam(':id', $id_question, PDO::PARAM_STR);
//    $res->execute();
//    $question = $res->fetchAll(PDO::FETCH_ASSOC);
//    $res->closeCursor();
//		return $question;
//}

//fonction crud pour afficher les réponses correctes
//
//function recherche_bonnes_reponses($connex, $id_question) {
//
//		$req = "SELECT question.enonce AS question, reponse.enonce_reponse AS reponse, reponse.id AS id_rep FROM question INNER JOIN reponse ON question.reponse_id = reponse.id WHERE question.id = :id";
//		$res = $connex->prepare($req);
//		$res->bindParam(':id', $id_question, PDO::PARAM_STR);
//		$res->execute();
//		$reponses = $res->fetchAll(PDO::FETCH_ASSOC);
//		$res->closeCursor();
//		return $reponses;
//
//}

//fonction crud pour insérer le score de l'élève

//function insertionScore($id_utilisateur, $score) {
//		$req = "UPDATE 
//}

function calculerDureeEnSecondes($startTime, $endTime) {
    // Convertir les temps en timestamps
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);
    
    // Calculer la durée en secondes
    $dureeEnSecondes = $endTimestamp - $startTimestamp;
    
    return $dureeEnSecondes;
}

function calculScore($dureeEnSecondes) {
	//calcul du score selon le temps mis à répondre
	switch ($dureeEnSecondes) {
 		case 0 <= $dureeEnSecondes < 1:
 			return 1000;
 		break;
 		case 1 <= $dureeEnSecondes < 2:
 			return 950;
 		break;
 		case 2 <= $dureeEnSecondes < 3:
 			return 900;
 		break;
 		case 3 <= $dureeEnSecondes < 4:
 			return 850;
 		break;
 		case 4 <= $dureeEnSecondes < 5:
 			return 800;
 		break;
 		case 5 <= $dureeEnSecondes < 6:
 			return 750;
 		break;
 		case 6 <= $dureeEnSecondes < 7:
 			return 700;
 		break;
 		case 7 <= $dureeEnSecondes < 8:
 			return 650;
 		break;
 		case 8 <= $dureeEnSecondes < 9:
 			return 600;
 		break;
 		case 9 <= $dureeEnSecondes < 10:
 			return 550;
 		break;
 		case 10 <= $dureeEnSecondes < 11:
 			return 500;
 		break;
 		case 11 <= $dureeEnSecondes < 12:
 			return 450;
 		break;
 		case 12 <= $dureeEnSecondes < 13:
 			return 400;
 		break;
 		case 13 <= $dureeEnSecondes < 14:
 			return 350;
 		break;
 		case 14 <= $dureeEnSecondes < 15:
 			return 300;
 		break;
 		case 15 <= $dureeEnSecondes < 16:
 			return 250;
 		break;
 		case 16 <= $dureeEnSecondes < 17:
 			return 200;
 		break;
 		case 17 <= $dureeEnSecondes < 18:
 			return 150;
 		break;
 		case 18 <= $dureeEnSecondes < 19:
 			return 100;
 		break;
 		case 19 <= $dureeEnSecondes < 20:
 			return 50;
 		break;
 		case $dureeEnSecondes >= 20:
 			return 0;
 		break;
	 	default:
 			return 0;
 		break;
}
}



function recup_reponses_eleve() {
	require('crud/connection.php');
   $c = connection();
   require('crud/crud_functions.php');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//ici il faut récupérer les réponses de l'élève quand il valide, je ne sais pas vraiment comment faire ça
		$id_utilisateur = $_POST['user_id']; //on récupère à nouveau l'id de l'utilisateur pour l'envoyer dans la base de données ensuite
		$question_suivante = $_POST['question_suivante']; //ici on récupère un paramètre 'question suivante' qui est initialisé à false quand c'est l'élève qui envoie ses réponses, et true si c'est l'administrateur qui envoie la page de la question suivante
		if ($question_suivante == false) { //comme le paramètre question suivante est false, on sait que c'est l'élève qui a envoyé ses réponses donc on envoit les réponses dans la base de données
			$dateTimeFin = new DateTime();
			$heureFin = $dateTimeFin->date("Y-m-d H:i:s");
			$duree_reponse = calculerDureeEnSecondes($heureDebut, $heureFin);
			
			foreach ($bonnes_reponses as $rep) {
				if (!isset($_POST[$rep['id_rep']]) {
					//ici il faudrait calculer le score de l'élève en fonction de ses réponses justes et du temps qu'il a mis à répondre
					$score = 0;
				} else {
					$score = calculScore($duree_reponse);
				}
			}
			
			insertionScore($id_utilisateur, $score);
		}
	}
}

//fonction qui à partir de l'identifiant de la question, si celui-ci est inférieur à 40, appelle la fonction d'affichage des réponses à cocher. Si l'id de question est supérieur à 40, affiche la page de fin de quiz. Au lancement du quiz, cette fonction serait exécutée avec l'id de question 1, puis avec un id augmenté de 1 à chaque question suivante jusqu'à la 40ème.
function ctrl_quiz($id_question) {
	
	
	$question = recherche_question($c, $id_question);
	$reponses = recherche_reponses($c, $id_question);
	$bonnes_reponses = recherche_bonnes_reponses($c, $id_question);
	
	if ($question_suivante == true) {
		if ($id_question >= 40) { //si l'admin passe à la question suivante, et que l'id de question est supérieur à 40, on affiche la fin du quiz
			ctrl_page_fin_quiz();
		} elseif ($id_question <= 40) { //si l'admin passe à la question suivante, mais que l'id de question est inférieur à 40, on affiche la question suivante
			$dateTimeDebut = new DateTime();
			$heureDebut = $dateTimeDebut->date("Y-m-d H:i:s");
			ctrl_vue_quiz($id_question, $id_utilisateur, $reponses);
			
	} elseif ($question_suivante == false) { //sinon, on affiche la page d'attente de la question suivante
		ctrl_vue_page_attente_question_suivante();
	}
}
}



