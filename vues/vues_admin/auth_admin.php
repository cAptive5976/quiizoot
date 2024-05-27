
<?php
include('blocs/header.php');
  

    ?>

    <h1>Connexion (Admin)</h1>
    <form action="login.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        <a href=""><button type="submit">Se connecter</button></a>
    </form>
</body>
</html>
