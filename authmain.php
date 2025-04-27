<?php


require("variables.inc.php");// contient les info de connection a la bd
session_start();
if (isset($_REQUEST['userid']) && isset($_REQUEST['password']))
{
// Si l’utilisateur a essayé d’ouvrir une session
$userid = $_REQUEST['userid'];
$password = $_REQUEST['password'];
$db = new mysqli ($bdserver, $bdlogin, $bdpwd,$bd);
//$query = "select * from auth where name='$userid' and pass=password('$password')";
$query = "select * from Client where Nom ='$userid' and Password='$password'";
$result = $db->query($query);
if ($result->num_rows >0 )
{
// s’il est enregistré dans la base de données
$_SESSION['valid_user'] = $userid;
header("Location: $url/Boutique.php");

}
else{

echo ' <script>  alert("Echec de la connexion. Mot de passe ou odentifiant incorrect"); </script>';
   
}
}
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
<h1>Page D’accès Client</h1>
<?php
if (isset($_SESSION['valid_user']))
{
echo '<p>Vous êtes connecté(e) en tant que : '.$_SESSION['valid_user'].' </p><br />';
echo '<a href="librairie/Boutique.php">Magasin</a><br />';

echo '<a href="logout.php">Fermer votre session</a><br />';
}
else
{
if (isset($userid))
{
// si l’utilisateur s’est mal loggué
echo 'Accès refusé';
}
else
{
// l’utilisateur n’a pas de session ouverte
echo '<p>Vous n’êtes pas connecté(e).</p><br />';
}
// formulaire du login
echo '<form method="post" action="authmain.php">';
echo '<table>';
echo '<tr><td>Nom complet :</td>';
echo '<td><input type="text" name="userid"></td></tr>';
echo '<tr><td>Mot de passe :</td>';
echo '<td><input type="password" name="password"></td></tr>';
echo '<tr><td colspan="2" align="center">';

echo '<input type="submit" value="Entrer"></td></tr>';
echo '<tr > <td colspan = "2" align = "center">Vous n\'avez pas de compte ? <a href = "librairie/creerCompte.php">Créez un Compte</a> </td></tr> ';

echo '</table>';
echo '</form>';
}
?>


</body>
</html>