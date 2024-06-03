<?php

include('vues/blocs/header.php');

echo '<form action="index.php?route=login_user" method="post">';

    echo '<h3>Connexion</h3>';

    echo "<label for='username'>Nom d'utilisateur</label>";
    echo '<input type="text" placeholder="Login" id="username">';

    echo '<label for="password">Mot de passe</label>';
    echo '<input type="password" placeholder="Password" id="password">';

    echo "<button type='submit' class='button_connex'>Log In</button>";

echo '</form>';

include('vues/blocs/footer.php');