<?php
function vue_quiz_admin($id_question, $reponses) {
    require('vues/blocs/header.php');
    
    echo '<h2>QUIZZ</h2>';
    
    echo '<h1>Question n° ' . $id_question . ' : ' . $reponses[0]['question'] . '</h1>';
	
	echo "<form action='index.php?route=route pas encore définie' method='post'> 
				<fieldset>
				<legend>Choisir une ou plusieurs réponses : </legend>"
	
	foreach ($reponses as $rep) {
        echo '<p>' . $rep['reponse'] . '<input type="checkbox" value="' . $rep['id_rep'] . '"name="rep' . $rep['id_rep'] . '" /></p>';
    }
					
	echo '		<input type="hidden" name="id_utilisateur" value="id de l\'utilisateur" />
				<p><input type="submit" value="Valider" /></p></fieldset>
			</form>';
    
    echo '<a href=vue_quiz.php?';
	
	require('vues/blocs/footer.php');
}

//Requête SQL possible pour obtenir les réponses (je ne suis pas sûr):
//
//SELECT question.enonce AS question, reponse.enonce_reponse AS reponse, reponse.id AS id_rep FROM question
//INNER JOIN reponse ON question.reponse_id = reponse.id
//WHERE question.id = :id;