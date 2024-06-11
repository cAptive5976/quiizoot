<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php?route=login_user'); // Si pas connecté, envoie sur la page de connexion
    exit();
}

function vue_reponses($id_question, $question, $reponses, $id_utilisateur) { //fonction permettant d'afficher la question et les réponses à cocher
    require('vues/blocs/header.php');

    echo '<h1 class="vue_question">Question n° ' . $id_question . ' : ' . $question[0]['enonce'] . '</h1>'; // Affichage de la question à partir du tableau obtenu par la requête SQL

    echo '<form class="vue_form" action="index.php?route=quiz&id_user=' . $id_utilisateur . '&id_question=' . ($id_question + 1) . '" method="post">'; //lorsque le formulaire est validé, envoi vers la route du quiz, avec l'id de l'élève qui répond au quiz et l'id de la question suivante à afficher
    echo '<fieldset>
            <legend>Choisir une réponse : </legend>'; //ouverture de la balise des champs de réponse avec la légende

    foreach ($reponses as $rep) { //boucle itérant sur chaque élément du tableau des réponses à afficher, à chaque tour de boucle (variable rep) on a une ligne du tableau reponses
        echo '<p>' . $rep['enonce_reponse'] . '<input type="radio" value="' . $rep['id'] . '" name="response" /></p>'; //pour chaque réponse à cocher, on affiche l'énoncé de la réponse, ayant comme valeur l'id de la réponse et comme nom 'response' (afin d'être récupéré dans le controleur)
    }

    echo '<p><input type="submit" value="Valider" /></p></fieldset>
          </form>'; //bouton de validation

    require('vues/blocs/footer.php');
}

function vue_page_fin_quiz() { //fonction permttant d'afficher la fin du quiz
    require('vues/blocs/header.php');

    echo '<p id="quiz_finished">Merci d\'avoir participé au quiz</p>';

    require('vues/blocs/footer.php');
}