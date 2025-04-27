<?php
require("variables.inc.php");
session_start();
if (isset($_REQUEST['userid']) && isset($_REQUEST['password']))
{
// Si l’utilisateur a essayé d’ouvrir une session
$userid = $_REQUEST['userid'];
$password = $_REQUEST['password'];
$db = new mysqli ($bdserver, $bdlogin, $bdpwd,$bd);
//$query = "select * from auth where name='$userid' and pass=password('$password')";
$query = "select * from auth where name='$userid' and pass='$password'";
$result = $db->query($query);
if ($result->num_rows >0 )
{
// s’il est enregistré dans la base de données
$_SESSION['admin'] = $userid;
}
}
?>
<?php
if (isset($_SESSION['admin']))
{
header("Location: $url2/index.php");	
echo 'Vous êtes connecté(e) en tant que : '.$_SESSION['admin'].' <br />';
echo '<a href="logout.php">Fermer votre session</a><br />';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8"/>
   <title>MAGASIN XYZ</title>
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
		<a href="librairie/cmd_all.php">Voir Commandes</a>
		</nav>
<h1>Page D’accès de l administrateur</h1>

<?php


if ((isset($userid)) && (empty($_SESSION['admin'])))
{
// si l’utilisateur s’est mal loggué


echo ' <script>  alert("Accès refusé. Mot de passe ou i></dentifiant incorrect"); </script>';
   

echo 'Accès refusé';
}
else
{
// l’utilisateur n’a pas de session ouverte
echo 'Vous n’êtes pas connecté(e).<br />';
}
// formulaire du login
echo '<form method="post" action="authAdmin.php">';
echo '<table>';
echo '<tr><td>Identité :</td>';
echo '<td><input type="text" name="userid"></td></tr>';
echo '<tr><td>Mot de passe :</td>';
echo '<td><input type="password" name="password"></td></tr>';
echo '<tr><td colspan="2" align="center">';
echo '<input type="submit" value="Entrer"></td></tr>';
echo '</table></form>';
?>
<br>
</body>
</html>