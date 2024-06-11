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
if (isset($_SESSION['user'])) { //si la variable de session user existe
    list($prenom, $nom, $classe) = explode(' ', $_SESSION['user'], 3); //Nous récupérons trois varibles : prenom, nom et classe grâce à la fonction explode, qui produit un tableau de 3 valeurs à partir d'une chaine de caractère de 3 mots séparés par 2 espaces
}

function ctrl_quiz() { //fonction principale de controle du quiz, gérant le passage à la question suivante, le temps de réponse et l'enregistrement des réponses
    global $c, $prenom, $nom, $classe; //nous déclarons les variables globales c (paramètres de connexion à la base de données), prenom, nom et classe, afin de pouvoir les utiliser dans cette fonction (car déclarées plus haut (l.9 pour connexion et l.17 pour nom, prenom et classe) en dehors de la fonction)

    $id_question = intval($_GET['id_question']); // on récupère l'identifiant de la question depuis la route, ainsi que l'id utilisateur
    $id_utilisateur = recherche_id_utilisateur($c, $prenom, $nom, $classe); //Nous recherchons l'identifiant de l'utilisateur dans la base de données (cf. fonction crud) grâce aux données de connexion à celle-ci (variable c), et au nom, prenom et classe de l'utilisateur

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $heureDebut = $_SESSION['heureDebut']; //si la page est appelée par la méthode POST, alors nous récupérons la variable de session heureDebut qui correspond à l'heure de lancement de la question par l'élève
        recup_reponses_eleve($id_utilisateur, $id_question - 1, $heureDebut); //ici nous récupérons l'id de l'élève, l'id de question précédent (car lorsque nous passons à la question suivante, nous appelons l'id de la question suivante et non l'id de la question qui vient d'être répondue, et que l'on souhaite enregistrer, ainsi que l'heure de début qui sera soustraite de l'heure de fin (moment où la réponse est envoyée) afin de déterminer le temps de réponse).
    }

    $question = recherche_question($c, $id_question); //ici nous recherchons la question qui sera affichée en haut de l'écran
    $reponses = recherche_reponses($c, $id_question); //ainsi que les réponses à cocher

    if ($id_question >= 35) { // si l'id de question est supérieur à 35, on affiche la fin du quiz
        ctrl_page_fin_quiz();
    } else { // si l'id de question est inférieur à 35, on affiche la question suivante
        $dateTimeDebut = new DateTime(); //nouvel objet DateTime afin d'obtenir l'heure de début
        $_SESSION['heureDebut'] = $dateTimeDebut->format("Y-m-d H:i:s"); //conversion de l'objet en année-mois-jour heure:minutes:secondes que nous récupérons dans la variable de session heureDebut
        ctrl_vue_quiz($id_question, $question, $reponses, $id_utilisateur); //Affichage de la page du quiz avec les réponses à cocher, pour l'id de question appelé, la question qui sera affichée, les réponses ainsi que l'id utilisateur
    }
}

function ctrl_vue_quiz($id_question, $question, $reponses, $id_utilisateur) { //fonction du controleur affichage de la page du quiz
    require_once('vues/vue_quiz.php');
    vue_reponses($id_question, $question, $reponses, $id_utilisateur);
}

function ctrl_page_fin_quiz() { //fonction du controleur d'affichage de la page de fin du quiz
    require_once('vues/vue_quiz.php');
    vue_page_fin_quiz();
}

function calculerDureeEnSecondes($startTime, $endTime) { //fonction permettant de calculer une durée en secondes à partir d'une heure de début et de fin
    // Convertir les temps en timestamps
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);

    // Calculer la durée en secondes
    return $endTimestamp - $startTimestamp;
}

function recup_reponses_eleve($id_utilisateur, $id_question, $heureDebut) { //fonction permettant de récupérer les réponses de l'élève et d'enregistrer son temps de réponse dans la base de données
    global $c; //Nous incluons dans la fonction, la variable globale c (connexion à la base de données)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //si la méthode de demande de la page est POST, nous savons que l'élève envoit ses réponses et nous les récupérons afin de savoir si elles sont justes et si tel est le cas, nous enregistrons le temps de réponse
        $bonne_reponse = recherche_bonnes_reponses($c, $id_question); //ici nous appelons une fonction CRUD permettant d'obtenir l'identifiant de la ou les bonne(s) réponse(s) (er uniquement la(es) bonne(s) réponse(s) pour chaque question, cf. fonctions crud)
        $user_response = isset($_POST['response']) ? (int)$_POST['response'] : null; //ici, nous récupérons la ou les réponses de l'élève et nous transformons en entier le/les id de réponses envoyés depuis le formulaire, si aucun id de réponse n'est récupéré (variable POST vide), donc qu'aucune réponse n'est cochée, cette variable est initialisée à null

        $dateTimeFin = new DateTime(); //nous créons un nouvel objet dateTimeFin correspondant à l'heure de fin de la réponse (clic sur question suivante)
        $heureFin = $dateTimeFin->format("Y-m-d H:i:s"); //nous transformons cet objet en heure et date
        $duree_reponse = floor(calculerDureeEnSecondes($heureDebut, $heureFin)); //nous calculons la durée en secondes et arrondissons grâce à la fonction floor, à l'entier inférieur (car nous ne pouvons enregistrer que des entiers dans la table resultat)

        // Si la durée de réponse est au déla de 20 seconde, on considère que c'est 20 secondes / 0 points
        if ($duree_reponse > 20) {
            $duree_reponse = 20;
        }

        if ($user_response == $bonne_reponse) { //si la ou les réponses reçues correspondent aux réponses justes, alors on insère le temps de réponse, sinon, ce n'est pas pris en compte
            insertionTempsReponse($c, $id_utilisateur, $id_question, $duree_reponse);
        }
    }
}
