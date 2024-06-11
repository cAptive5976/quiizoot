<?php

include('vues/blocs/header.php');


// Affiche une alerte si une session 'red_alert' ou 'green_alert' est définie.
// 'red_alert' pour les messages d'erreur.
// 'green_alert' pour les messages de succès.
 
if (isset($_SESSION['red_alert'])) {
    echo '<div class="alert red_alert">' . $_SESSION['red_alert'] . '</div>';
    unset($_SESSION['red_alert']);
}
if (isset($_SESSION['green_alert'])) {
    echo '<div class="alert green_alert">' . $_SESSION['green_alert'] . '</div>';
    unset($_SESSION['green_alert']);
}

 
// Ce formulaire permet aux administrateurs de se connecter en fournissant
// leur prénom, nom et mot de passe. Les données du formulaire sont envoyées
// via la méthode POST à l'URL 'index.php?route=login_admin'.

echo '<form action="index.php?route=login_admin" method="post">';

    echo '<h3>Connexion admin</h3>';

    // Champ de saisie pour le prénom de l'administrateur
    echo "<label for='username'>Prénom</label>";
    echo '<input type="text" placeholder="Prénom" name="prenom" id="prenom">';

    // Champ de saisie pour le nom de famille de l'administrateur
    echo "<label for='surname'>NOM</label>";
    echo '<input type="text" placeholder="NOM" name="nom" id="nom">';

    // Champ de saisie pour le mot de passe de l'administrateur
    echo '<label for="password">Mot de passe</label>';
    echo '<input type="password" placeholder="Mot de passe" name="password" id="password">';

    // Bouton pour soumettre le formulaire
    echo "<button type='submit' class='button_connex'>Connexion</button>";

echo '</form>';

include('vues/blocs/footer.php');
?>
