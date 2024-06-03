<?php

include('vues/blocs/header.php');
  
echo '<h1> Connexion administrateur</h1>';
echo '<p><form action="index.php?route=login_user" method="post">';
echo '<label for="nom">Nom :</label>';
echo '<input type="text"  name="nom" required><br><br>';
echo '<label for="prenom">Prénom :</label>';
echo '<input type="text" name="prenom" required><br><br>';
echo "<button type='submit' class='button_connex'>Connexion</button>";
echo '</form></p>';

include('vues/blocs/footer.php');