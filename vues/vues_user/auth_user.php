<?php

require ('vues/blocs/header.php');

echo '<form action="index.php?route=login_user" method="post">';

    echo '<h3>Connexion invités</h3>';

    echo "<label for='username'>Prénom</label>";
    echo '<input type="text" placeholder="Prénom" name="prenom" id="prenom">';

    echo "<label for='surname'>NOM</label>";
    echo '<input type="text" placeholder="NOM" name="nom" id="nom">';

    echo '<label for="classe">Choisissez votre classe:</label>';
    echo '<div class="select-wrapper">';
        echo '<select id="select" name="classe">';
            echo '<option value="général">Général</option>';
            echo '<option value="sti2d">STI2D</option>';
        echo '</select>';
    echo '</div>';

    echo "<button type='submit'>Jouez !</button>";

echo '</form>';

require('vues/blocs/footer.php');
?>