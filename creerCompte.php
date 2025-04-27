<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <title>MAGASIN ajout d' article</title>
   <meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="logo.jpg">
	</head>
	<body>
		<img src="logo.jpg">
		<h2>MAGASIN XYZ</h2>

<?php
	session_start();
	require("variables.inc.php");
	if (isset($_POST['userid']) && isset($_POST['password']))
	
	{
		$_SESSION['valid_user'] = $userid;
		$adresse = $_POST['adresse'];
		$userid = $_POST['userid'];
		$password = $_POST['password'];
		$db = new mysqli ($bdserver, $bdlogin, $bdpwd,$bd);
		print ($adresse,$bdserver,$bdlogin,$bdpwd,$bd,$userid,$password);
		$query ="INSERT INTO Client (Nom, Adresse , Password) VALUES('$userid','$adresse' '$password')";
		
		$result = $db->query($query);
		if($result){
		    echo ' <script>  alert("Insertion Réussie"); </script>';
			header("Location: $url/Boutique.php");
		}
	}	
	
	echo '<form method="post" action="">';
	echo '<table>';
	echo '<tr><td>Nom :</td>';
	echo '<td><input type="text" name="userid" required = "required"></td></tr>';
	echo '<tr><td>Adresse :</td>';
	echo '<td><input type="text"  name="adresse" required = "required"></td></tr>';
	echo '<tr><td>Mot de passe :</td>';
	echo '<td><input type="password" name="password" required = "required"></td></tr>';
	echo '<tr><td colspan="2" align="center">';
	echo '<input type="submit" value="Enregistrer"></td></tr>';
	echo '</table></form>';
?>
</body>
</html>