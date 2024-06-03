<?php

include('vues/blocs/header.php');

echo '<form action="index.php?route=login_user" method="post">';

    echo '<h3>Connexion</h3>';

    echo "<label for='username'>Prénom</label>";
    echo '<input type="text" placeholder="Prénom" id="prenom">';

    echo "<label for='surname'>NOM</label>";
    echo '<input type="text" placeholder="NOM" id="nom">';

    echo '<label for="password">Mot de passe</label>';
    echo '<input type="password" placeholder="Mot de passe" id="password">';

    echo "<button type='submit' class='button_connex'>Connexion</button>";

echo '</form>';

include('vues/blocs/footer.php');