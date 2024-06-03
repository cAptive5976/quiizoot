<?php

function results_cleaner($connex) {
    $req = "DELETE FROM resultat"; // Efface toute la table resultat

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
    $req = "SELECT u.prenom, u.nom FROM users u WHERE u.prenom = :prenom AND u.nom = :nom AND u.isadmin = true";
    $stmt = $connex->prepare($req);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->execute();
    $login = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    if (empty($login)) {
        return null;
    }

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


