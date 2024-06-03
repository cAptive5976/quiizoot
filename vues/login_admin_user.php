<?php 
require('blocs/header.php');

echo "<h1>Se connecter :<h1>";
echo "<a href='index.php?route=login_admin' class=button>Admin</a>";
echo "<a href='vues/vues_user/auth_user.php' class=button>Utilisateur</a>";

require('blocs/footer.php');