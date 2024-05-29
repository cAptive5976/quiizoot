<?php

function results_cleaner($connex) {
    $req = "DELETE FROM resultat"; // Efface toute la table resulats

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
