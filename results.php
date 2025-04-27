<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="logo.jpg">
	</head>
	<body>
		<img src="logo.jpg">
		<h2>MAGASIN XYZ</h2>		
		<nav >		
		<a href="../liste_produit.php" >Accueil</a>
		<a href="../rechLivres.html" >Rechercher</a>
		<a href="../insertion.html" >Ajouter</a>
		<a href="../rechAffichTab.html">Modif-affichage</a>
		<a href="../modifLivre.html">Modif-simple</a>		
		<a href="../authmain.php">MAGASIN</a> 
		<a href = "librairie/cmd_all.php">Voir Toutes les Commandes</a>
		
		</nav>
		
		
    <h1>RÉSULTATS DE LA RECHERCHE</h1>

    <?php
    require("variables.inc.php");
    /*if(empty($_POST['typeRech']) || empty($_POST['termeRech'])){
        echo 'Vous n\'avez entré aucun critère de recherche. Veuillez réessayer !';
        exit;
    }*/
 $typeRech = $_POST['typeRech']; 
    $termeRech = $_POST['termeRech'];
$termeRech = trim($termeRech);

    $typeRech = addslashes($typeRech); 
    $termeRech = addslashes($termeRech);

    $db = new mysqli($bdserver, $bdlogin, $bdpwd,$bd);

    if($db->connect_error){
        die("Erreur: échec de la connexion à la base de données. Veuillez réessayer plus tard.");
    }

    $query = "SELECT * FROM produits WHERE  $typeRech LIKE '%$termeRech%' ";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    echo '<p>Nombre d article (s) trouve (s) : ' . $num_results . '</p>';
    echo"<table border='1'>
    		<tr><th>Nom</th><th>Categorie</th><th>Quantite</th><th>Prix</th>
    		</tr>";
    while($row = $result->fetch_assoc()) {
        echo '<tr><td><strong>' . htmlspecialchars(stripslashes($row['nom'])) . '</strong></td>';
        echo '<td>' . stripslashes($row['categorie']) . '</td>';
        
        echo '<td> ' . stripslashes($row['stock']) . '</td>';
        echo '<td>' . stripslashes($row['prix']) . '</td> </tr>';
    }
    echo"</table>";
    $db->close();
    ?>

</body>
</html>