<?php 
include("variables.inc.php");
header("Location: $url2/insertion.html");	

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
   <title>Bibliotheque ajout de livre</title></title>
   <meta charset='utf-8'/>
		<link rel='stylesheet' href='style.css'>
		<link rel='icon' href='logo.jpg'>
	</head>
	<body>
		<nav >		
		<a href='liste_produit.php' >Accueil</a>
		<a href='rechLivres.html' >Rechercher</a>
		<a href='insertion.html' >Ajouter</a>
		<a href='rechAffichTab.html'>Modif-affichage</a>
		<a href='modifLivre.html'>Modif-simple</a>		
		<a href='authmain.php'>MAGASIN</a> 
		<a href = "librairie/cmd_al.php">Voir Toutes les Commandes</a>
		
		</nav>
		
		<img src='logo.jpg'>
		<h2>Bibliotheque du savoir</h2>

<body>
   <h2>AJOUT DE LIVRE</h2>
   <?php
	$nom = $_POST['nom'];
	$categorie = $_POST['categorie'];
	$stock = $_POST['stock'];
	$prix = $_POST['prix'];
	/*
	if(!$nom || !$categorie || !$titre || !$prix){
	   echo 'Veuillez remplir tous les champs';
	   exit;
	}
	*/
	$nom = addslashes($nom);
	$categorie = addslashes($categorie);
	@$db = new mysqli('0.0.0.0','moi','motdepasse','magasin');
	if($db->connect_error){
	   echo 'Probleme de connexion avec la base de donnees';
	   exit;
	}
	$query = "insert into produits(nom,categorie,stock,prix) values('$nom','$categorie','$stock','$prix')";
$result = $db->query($query);
if($result){

   echo ' <script>  alert("Insertion Réussie"); </script>';
   	
   exit;
}
else{
   echo ' <script>  alert("Echec de l \'insertion. Veuillez reessayer plus tard"); </script>';
   exit;
}

?>

</body>
</html>