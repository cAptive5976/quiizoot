<?php
session_start();
session_destroy();
header('Location: index.php'); // Redirection vers l'accueil
exit();
?>
