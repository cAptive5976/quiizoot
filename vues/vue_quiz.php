<?php

function afficherCompteARebours($seconds) {
    while ($seconds > 0) {
        echo "<p>Il reste $seconds secondes.</p>";
        sleep(1); // Attendre une seconde
        $seconds--;
    }
    echo "<p>Le temps est écoulé !</p>";
}

function vue_reponses($id_question, $reponses, $id_utilisateur) {
	require('vues/blocs/header.php');
    
	echo '<h2>QUIZZ</h2>';
    
	echo '<h1>Question n° ' . $id_question . ' : ' . $reponses[0]['question'] . '</h1>'; //Affichage de la question à partir du tableau obtenu par la requête SQL
	
	
	echo '<form action="index.php?route=quiz?question="' . $id_question + 1 . 'method="post">'; //quand le formulaire est validé (que l'élève a choisi ses réponses et cliqué sur valider), on envoit son identifiant (champ hidden) ainsi que ses réponses au ctrl_quiz qui les enverra au crud.
	echo '		<fieldset>
				<legend>Choisir une ou plusieurs réponses : </legend>';
	
	foreach ($reponses as $rep) {
        echo '		<p>' . $rep['reponse'] . '<input type="checkbox" value="' . $rep['id_rep'] . '"name="' . $rep['id_rep']. '" /></p>';
    }
					
	echo    '	<input type="hidden" name="id_utilisateur" value="' . $id_utilisateur . '" />';
	echo    '	<input type="hidden" name="question_suivante" value=false />';
	echo	'	<p><input type="submit" value="Valider" /></p></fieldset>
			</form>';
   
   afficherCompteARebours(20);
	
	require('vues/blocs/footer.php');
}


function vue_page_fin_quiz() {
	require('vues/blocs/header.php');
    
	echo '<h2>QUIZZ</h2>';
   
	echo '<p>Merci d\'avoir participé au quiz</p>';    
   
	require('vues/blocs/footer.php');
}

function vue_attente_question_suivante() {
	require('vues/blocs/header.php');
    
	echo '<h2>QUIZZ</h2>';
   
	echo '<p>Merci de patienter, la question suivante s\'affichera lorsque tout le monde aura répondu, ou à la fin des 20 secondes.</p>';    
   
	require('vues/blocs/footer.php');
}