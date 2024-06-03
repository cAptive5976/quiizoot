<?php

require ('../blocs/header.php');

echo '<h1> Connexion utilisateur</h1>';
echo '<p><form action="index.php?route=login_user" method="post">';
echo '<label for="nom">Nom :</label>';
echo '<input type="text" name="nom" required><br><br>';
echo '<label for="prenom">Prénom :</label>';
echo '<input type="text" name="prenom" required><br><br>';
echo '<label for="classe">Choisissez votre classe:</label>';
echo '<select id="classe" name="classe">';
echo '<option value="général">Général</option>';
echo '<option value="sti2d">STI2D</option>';
echo '</select><br><br>';
echo "<button type='submit' class='button_connex'>Connexion</button>";
echo '</form></p>';

require('../blocs/footer.php');