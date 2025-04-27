<?php
session_start();
$old_user = $_SESSION['valid_user']; // pour savoir ensuite si l’utilisateur a été connecté
unset($_SESSION['valid_user']);
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8"/>
   
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="logo.jpg">
	</head>
	<body>
	<img src="logo.jpg">
	<h2>Magasin XYZ</h2>
		<nav >		
		<a href="index.php" >Accueil</a>
		<a href="rechLivre.html" >Rechercher</a>	
		<a href="authmain.php">MAGASIN</a> 
		<a href="librairie/cmdclient.php">Vos commandes</a>
		</nav>
<h1>Fermeture de la SESSION</h1>
<?php
if (!empty($old_user))
{
echo 'session fermée.<br />';
}
else
{
// si l’utilisateur n’avait pas pu ouvrir une session mais qui est parvenu à cette page
echo 'Pas besoin de fermer la session car elle n’a pas été ouverte pour vous.<br />';
}
?>
<a href="authmain.php">retour page principale</a>
</body>
</html>