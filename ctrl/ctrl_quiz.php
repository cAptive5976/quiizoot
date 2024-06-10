<?php

//CE PROJET EST TROP DUR : MON CODE EST COMPLETEMENT FOIREUX -> ATTENTION LE CAHIER DES CHARGES NE SERA PAS RESPECTE

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

//controleur de l'affichage de la page d'attente de la question suivante : CETTE FONCTION NE SERA PAS UTILISEE CAR TROP DUR DE GERER LA TRANSITION PAR L'ADMIN

function ctrl_vue_page_attente_question_suivante() { //NON UTILISEE
	require('vues/vue_quiz.php');
	vue_page_attente_question_suivante();
}

//fonction qui, à partir du prénom, du nom et de la classe, cherche l'identifiant de l'utilisateur (élève). Logiquement, cette fonction sera appelée une seule fois au moment de lancer le quiz, avec le nom prénom et classe de l'élève qui s'est inscrit.
//cette fonction devrait peut être plutôt être appelée dans la file d'attente
function ctrl_id_user($prenom, $nom, $classe) {
	require('crud/connection.php');
	$c = connection();
	require('crud/crud_functions.php');
	$id_utilisateur = recherche_id_utilisateur($prenom, $nom, $classe); //recherche de l'identifiant de l'utilisateur
}

//<<<<<<< HEAD

//
//	Ici faire une requête SQL pour insérer le temps de réponse de l'élève
//
// Proposition de fonction CRUD (à vérifier par Charles qui fait les fonctions CRUD)

// function insertionTempsReponse($id_utilisateur, $id_question, $duree_reponse) {
//		$req = "INSERT INTO resultat (user_id, question_id, temps) VALUES (:id_utilisateur, :id_question, :duree_reponse)";
//    $res = $connex->prepare($req);
//    $res->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_STR);
//    $res->bindParam(':id_question', $id_question, PDO::PARAM_STR);
//    $res->bindParam(':duree_reponse', $duree_reponse, PDO::PARAM_STR);
//    $res->execute();
//}

function calculerDureeEnSecondes($startTime, $endTime) {
    // Convertir les temps en timestamps
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);
    
    // Calculer la durée en secondes
    $dureeEnSecondes = $endTimestamp - $startTimestamp;
    
    return $dureeEnSecondes;
}



function recup_reponses_eleve($id_utilisateur, $id_question, $heureDebut) {
	require('crud/connection.php');
   $c = connection();
   require('crud/crud_functions.php');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//ici il faut récupérer les réponses de l'élève quand il valide, je ne sais pas vraiment comment faire ça
		
		$dateTimeFin = new DateTime();
		$heureFin = $dateTimeFin->date("Y-m-d H:i:s");
		$duree_reponse = floor(calculerDureeEnSecondes($heureDebut, $heureFin)); //on calcule la durée en secondes et on arrondit à la seconde inférieure
		
		foreach ($bonnes_reponses as $rep) {
			if (!isset($_POST[strval($rep['id_rep'])]) {
				break; //si on trouve une mauvaise réponse, on casse la boucle et le temps de réponse n'est pas enregistré
			} else {
				insertionTempsReponse($id_utilisateur, $id_question, $duree_reponse);
			}
		}
	}
}

//=======
//>>>>>>> 4783acd8c486481c2c856c8f62591f7e881c0c20
//fonction qui à partir de l'identifiant de la question, si celui-ci est inférieur à 40, appelle la fonction d'affichage des réponses à cocher. Si l'id de question est supérieur à 40, affiche la page de fin de quiz. Au lancement du quiz, cette fonction serait exécutée avec l'id de question 1, puis avec un id augmenté de 1 à chaque question suivante jusqu'à la 40ème.
function ctrl_quiz() {
	
	$id_question = intval($_GET['id_question']); //on récupère l'identifiant de la question depuis la route, ainsi que l'id utilisateur
	$id_utilisateur = intval($_GET['id_user']);
	//$question_suivante = $_SESSION['question_suivante']; //ici on récupère un paramètre de session 'question suivante' qui sera true si l'administrateur envoie la page de la question suivante, pas sûr qu'il faut faire comme ça pour gérer le passage à la question suivante par l'admin
		
	$question = recherche_question($c, $id_question);
	$reponses = recherche_reponses($c, $id_question);
	$bonnes_reponses = recherche_bonnes_reponses($c, $id_question);
	
	//if ($question_suivante == true) { //on n'utilise plus de paramètre qquestion_suivante, afin que les élèves passent à la question suivante sans l'admin, car c'est trop dur à faire
		if ($id_question >= 35) { //si l'id de question est supérieur à 35, on affiche la fin du quiz
			ctrl_page_fin_quiz();
		} elseif ($id_question <= 35) { //si l'id de question est inférieur à 35, on affiche la question suivante
			$dateTimeDebut = new DateTime();
			$heureDebut = $dateTimeDebut->date("Y-m-d H:i:s");
			ctrl_vue_quiz($id_question, $id_utilisateur, $reponses);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				recup_reponses_eleve($id_utilisateur, $id_question-1, $heureDebut); //comme ce controleur est appelé avec l'id de question suivante lorsque l'élève envoie ses réponse, afin de pouvoir enregistrer le temps de la réponse à la question à laquelle il vient de répondre, on enlève 1 à l'id de question
			}
			
	//} elseif ($question_suivante == false) { //sinon, on affiche la page d'attente de la question suivante
	//	ctrl_vue_page_attente_question_suivante();
	//}
}
}



