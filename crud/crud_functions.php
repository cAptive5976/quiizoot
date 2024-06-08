<?php

function results_cleaner($connex) {
    $req = "DELETE FROM resultat"; // Efface toute la table resultat

    $res = $connex->query($req);
    $res->closeCursor();
}
function user_cleaner($connex) {
    $req = "DELETE FROM users WHERE isadmin=false"; // Efface toute la table utilisateurs non-admin

    $res = $connex->query($req);
    $res->closeCursor();
}
function score_classe($connex) {
    $req = "SELECT u.prenom, u.nom, u.classe, sum(s.score) AS total_points
        FROM resultat r
        JOIN users u ON r.user_id = u.id
        JOIN score s ON r.temps = s.temps
        GROUP BY u.id
        ORDER BY u.classe, total_points DESC
    ";

    $res = $connex->query($req);
    $score = $res->fetchAll(PDO::FETCH_ASSOC);
    $res->closeCursor();
    return $score;
}

function login_admin_crud($connex, $prenom, $nom) {
    $req = "SELECT u.prenom, u.nom, u.isadmin, u.password FROM users u WHERE u.prenom = :prenom AND u.nom = :nom AND u.isadmin = true";
    $stmt = $connex->prepare($req);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->execute();
    $login = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $login;
}

function login_user_crud($connex, $prenom, $nom, $classe) {
    $req = "INSERT INTO users (prenom, nom, classe, isadmin) VALUES (:prenom, :nom, :classe, false)";
    $res = $connex->prepare($req);
    $res->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $res->bindParam(':nom', $nom, PDO::PARAM_STR);
    $res->bindParam(':classe', $classe, PDO::PARAM_STR);
    $res->execute();
}

function find_user_by_name($connex, $prenom, $nom, $classe) {
    $req = "SELECT * FROM users WHERE prenom = :prenom AND nom = :nom AND classe = :classe";
    $res = $connex->prepare($req);
    $res->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $res->bindParam(':nom', $nom, PDO::PARAM_STR);
    $res->bindParam(':classe', $classe, PDO::PARAM_STR);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
}

function get_users($connex) {
    $req = "SELECT prenom, nom, classe FROM users WHERE isadmin = false ORDER BY id ASC";
    $stmt = $connex->prepare($req);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $users;
}

// Fonctions CRUD de quiz

//fonction pour trouver l'id utilisateur à partir du nom, du prénom et de la classe de l'élève :
function recherche_id_utilisateur($connex, $prenom, $nom, $classe) {
    $req = "SELECT u.id FROM users u WHERE u.prenom = :prenom AND u.nom = :nom AND u.classe = :classe";
    $res = $connex->prepare($req);
    $res->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $res->bindParam(':nom', $nom, PDO::PARAM_STR);
    $res->bindParam(':classe', $classe, PDO::PARAM_STR);
    $res->execute();
    $id_utilisateur = $res->fetchAll(PDO::FETCH_ASSOC);
    $res->closeCursor();
    return $id_utilisateur;
}

//fonction crud pour afficher toutes les réponses à cocher selon l'id de question

function recherche_reponses($connex, $id_question) {
        $req = "SELECT id, enonce_reponse FROM reponse WHERE question_id = :id";
	    $res = $connex->prepare($req);
	    $res->bindParam(':id', $id_question, PDO::PARAM_STR);
        $res->execute();
        $reponses = $res->fetchAll(PDO::FETCH_ASSOC);
        $res->closeCursor();
	    return $reponses;
}

//fonction crud pour afficher lénoncé de la question a partir de son id

function recherche_question($connex, $id_question) {
		$req = "SELECT id, enonce FROM question WHERE id = :id";
		$res = $connex->prepare($req);
        $res->bindParam(':id', $id_question, PDO::PARAM_STR);
        $res->execute();
        $question = $res->fetchAll(PDO::FETCH_ASSOC);
        $res->closeCursor();
		return $question;
}

//fonction crud pour afficher les réponses correctes

function recherche_bonnes_reponses($connex, $id_question) {
		$req = "SELECT question.enonce AS question, reponse.enonce_reponse AS reponse, reponse.id AS id_rep FROM question INNER JOIN reponse ON question.reponse_id = reponse.id WHERE question.id = :id";
		$res = $connex->prepare($req);
		$res->bindParam(':id', $id_question, PDO::PARAM_STR);
		$res->execute();
		$reponses = $res->fetchAll(PDO::FETCH_ASSOC);
		$res->closeCursor();
		return $reponses;
}
