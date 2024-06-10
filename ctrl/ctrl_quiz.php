<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php?route=login_user'); // Si pas connecté, envoie sur la page de connexion
    exit();
}

require_once('crud/connection.php');
$c = connection();
require_once('crud/crud_functions.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php?route=login_user'); // Si pas connecter, envoit sur la page de connection
    exit();
}
if (isset($_SESSION['user'])) {
    list($prenom, $nom, $classe) = explode(' ', $_SESSION['user'], 3);
}

function ctrl_quiz() {
    global $c, $prenom, $nom, $classe;

    $id_question = intval($_GET['id_question']); // on récupère l'identifiant de la question depuis la route, ainsi que l'id utilisateur
    $id_utilisateur = recherche_id_utilisateur($c, $prenom, $nom, $classe);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $heureDebut = $_SESSION['heureDebut'];
        recup_reponses_eleve($id_utilisateur, $id_question - 1, $heureDebut);
    }

    $question = recherche_question($c, $id_question);
    $reponses = recherche_reponses($c, $id_question);

    if ($id_question >= 35) { // si l'id de question est supérieur à 35, on affiche la fin du quiz
        ctrl_page_fin_quiz();
    } else { // si l'id de question est inférieur à 35, on affiche la question suivante
        $dateTimeDebut = new DateTime();
        $_SESSION['heureDebut'] = $dateTimeDebut->format("Y-m-d H:i:s");
        ctrl_vue_quiz($id_question, $question, $reponses, $id_utilisateur);
    }
}

function ctrl_vue_quiz($id_question, $question, $reponses, $id_utilisateur) {
    require_once('vues/vue_quiz.php');
    vue_reponses($id_question, $question, $reponses, $id_utilisateur);
}

function ctrl_page_fin_quiz() {
    require_once('vues/vue_quiz.php');
    vue_page_fin_quiz();
}

function calculerDureeEnSecondes($startTime, $endTime) {
    // Convertir les temps en timestamps
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);

    // Calculer la durée en secondes
    return $endTimestamp - $startTimestamp;
}

function recup_reponses_eleve($id_utilisateur, $id_question, $heureDebut) {
    global $c;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bonne_reponse = recherche_bonnes_reponses($c, $id_question);
        $user_response = isset($_POST['response']) ? (int)$_POST['response'] : null;

        $dateTimeFin = new DateTime();
        $heureFin = $dateTimeFin->format("Y-m-d H:i:s");
        $duree_reponse = floor(calculerDureeEnSecondes($heureDebut, $heureFin));

        // Si la durée de réponse est au déla de 20 seconde, on considère que c'est 20 secondes / 0 points
        if ($duree_reponse > 20) {
            $duree_reponse = 20;
        }

        if ($user_response == $bonne_reponse) {
            insertionTempsReponse($c, $id_utilisateur, $id_question, $duree_reponse);
        }
    }
}
