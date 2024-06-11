<<?php

require('vues/blocs/header.php');


// Ce formulaire permet aux utilisateurs invités de se connecter en fournissant
// leur prénom, nom et classe. Les données du formulaire sont envoyées via la méthode POST
// à l'URL 'index.php?route=login_user'.

echo '<form action="index.php?route=login_user" method="post">';

    echo '<h3>Connexion invités</h3>';

    // Champ de saisie pour le prénom de l'utilisateur
    echo "<label for='username'>Prénom</label>";
    echo '<input type="text" placeholder="Prénom" name="prenom" id="prenom">';

    // Champ de saisie pour le nom de famille de l'utilisateur
    echo "<label for='surname'>NOM</label>";
    echo '<input type="text" placeholder="NOM" name="nom" id="nom">';

    // Sélecteur de classe pour l'utilisateur
    echo '<label for="classe">Choisissez votre classe:</label>';
    echo '<div class="select-wrapper">';
        echo '<select id="select" name="classe">';
            echo '<option value="général">Général</option>';
            echo '<option value="sti2d">STI2D</option>';
        echo '</select>';
    echo '</div>';

    // Bouton pour soumettre le formulaire
    echo "<button type='submit'>Jouez !</button>";

echo '</form>';

require('vues/blocs/footer.php');
?>
