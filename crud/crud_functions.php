<?php

function results_cleaner($connex) {
    $req = "DELETE FROM resultat"; // Efface toute la table resulats

    $res = $connex->query($req);
    $res->closeCursor();
}