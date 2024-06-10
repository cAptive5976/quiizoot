<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php?route=login_user'); // Si pas connecté, envoie sur la page de connexion
    exit();
}

function vue_reponses($id_question, $question, $reponses, $id_utilisateur) {
    require('vues/blocs/header.php');

    echo '<h2>QUIZZ</h2>';

    echo '<h1>Question n° ' . $id_question . ' : ' . $question[0]['enonce'] . '</h1>'; // Affichage de la question à partir du tableau obtenu par la requête SQL

    echo '<form action="index.php?route=quiz&id_user=' . $id_utilisateur . '&id_question=' . ($id_question + 1) . '" method="post">';
    echo '<fieldset>
            <legend>Choisir une réponse : </legend>';

    foreach ($reponses as $rep) {
        echo '<p>' . $rep['enonce_reponse'] . '<input type="radio" value="' . $rep['id'] . '" name="response" /></p>';
    }

    echo '<p><input type="submit" value="Valider" /></p></fieldset>
          </form>';

    require('vues/blocs/footer.php');
}

function vue_page_fin_quiz() {
    require('vues/blocs/header.php');

    echo '<h2>QUIZZ</h2>';

    echo '<p>Merci d\'avoir participé au quiz</p>';

    require('vues/blocs/footer.php');
}
?>
