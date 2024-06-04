<?php

include('vues/blocs/header.php');

echo '<form action="index.php?route=login_admin" method="post">';

    echo '<h3>Connexion admin</h3>';

    echo "<label for='username'>Prénom</label>";
    echo '<input type="text" placeholder="Prénom" name="prenom" id="prenom">';

    echo "<label for='surname'>NOM</label>";
    echo '<input type="text" placeholder="NOM" name="nom" id="nom">';

    echo '<label for="password">Mot de passe</label>';
    echo '<input type="password" placeholder="Mot de passe" name="password" id="password">';

    echo "<button type='submit' class='button_connex'>Connexion</button>";

echo '</form>';

include('vues/blocs/footer.php');