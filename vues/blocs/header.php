<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/global.css">
	<link rel="icon" type="image/png" href="/images/favicon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Quiizoot!</title>
</head>

<body>
<header>
	<div id="header">
        	<nav>
        		<a href="."><img src="images/Quiizoot!.png" alt="Logo de Quiizoot!" class="logo"></a>
        	     	<ul>
        	         	<li><a href="index.php?route=about">A PROPOS</a></li>
                        <?php
						// Ici on démare une session, si le role n'est ni user ni admin, alors affiche le boutton de connexion
                        session_start();
                        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user' && $_SESSION['role'] !== 'admin') {
                            echo '<li><a href="index.php?route=login">SE CONNECTER</a></li>';
                        }
						// Dans le cas contraire affiche le boutton de deconnexion, et le nom de l'utilisateur
                        else {
                            echo '<li><a href="index.php?route=logout">SE DECONNECTER</a></li>';
                            if (isset($_SESSION['user'])) {
                                 echo '<li>Utilisateur : ' . $_SESSION['user'] . '</li>';
                            }
                        }?>
        	     	</ul>
       		</nav>
     	</div>    
</header>

<article>