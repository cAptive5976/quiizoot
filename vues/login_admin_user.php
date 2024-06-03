<?php 
require('blocs/header.php');

echo "<h1>Se connecter :<h1>";
echo "<a href='index.php?route=login_admin'><button class='button'>Admin</a>";
echo "<a href='vues/vues_user/auth_user.php'><button class='button'>Utilisateur</a>";

require('blocs/footer.php');