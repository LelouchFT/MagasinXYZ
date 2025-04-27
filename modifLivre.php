<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="logo.jpg">
	</head>
	<body>
		<img src="logo.jpg">
		<h2>Bibliotheque du savoir</h2>		
		<nav >		
		<a href="liste_produit.php" >Accueil</a>
		<a href="rechLivres.html" >Rechercher</a>
		<a href="insertion.html" >Ajouter</a>
		<a href="rechAffichTab.html">Modif-affichage</a>
		<a href="modifLivre.html">Modif-simple</a>		
		<a href="authmain.php">MAGASIN</a> 
		<a href = "librairie/cmd_all.php">Voir Toutes les Commandes</a>
		
		</nav>
		
		<?php
require("variables.inc.php");
$typeRech = $_POST['typeRech'];
$termeRech = $_POST['termeRech'];
$termeRech = trim($termeRech); 
$typeRech = addslashes($typeRech);
$termeRech = addslashes($termeRech); 
$db = new mysqli($bdserver, $bdlogin, bdpwd, $bd);

if($db->connect_error) { 
    echo "❗❗❗ Erreur, échec de connexion à la base de données. Réessayez plus tard";
    exit;
} 
$query = "SELECT * FROM produits WHERE  $typeRech LIKE '%$termeRech%' ";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    echo '<p>Nombre d article (s) trouvé (s) : ' . $num_results . '</p>';
if($result){
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $nom = htmlspecialchars(stripslashes($row['nom']));
        
        $categorie = stripslashes($row['categorie']);
        $stock = stripslashes($row['stock']);
        $prix = stripslashes($row['prix']);
    }
    else{
        echo ' <script>  alert("Aucun résultat trouvé pour la recherche spécifiée."); </script>';
        exit;
    }
}
echo "<fieldset>
   <legend>MODIFICATION D UN PRODUIT</legend>

	<form action='' method='POST' >
    <table>
        <tr>
            
            <td><input type='hidden' name='nom' value='$nom'></td>
        </tr>
        <tr>
            <td>NOM :</td>
            <td><input type='text' name='nom' value='$nom'></td>
            
        </tr>
        <tr>
            <td>Categorie</td>
            <td><input type='text' name='categorie' value='$categorie'></td>
        </tr>
        
        <tr>
            <td>Entrer le nombre de produits en stock :</td>
            <td><input type='number' name='stock' value='$stock'></td>
        </tr>
        <tr>
            <td>Entrer le prix unitaire :</td>
            <td><input type='number' name='prix' value='$prix'></td>
        </tr>
    </table>
    <input type='submit' name='update' value='Enregistrer'>
    <input type='submit' name='delete' value='Supprimer'>
</form>
</fieldset>
<script src='verif.js'></script>";

if(isset($_POST['update'])){
    
    $nom = $_POST['nom'];
    $categorie = $_POST['categorie'];
    
    $stock = $_POST['stock'];
    $prix = $_POST['prix'];

    /*if(empty($isbn) || empty($auteur) || empty($titre) || empty($prix)){ // Correction des opérateurs logiques de comparaison
        echo '⚠️⚠️⚠️ Veuillez remplir tous les champs';
        exit;
    }
*/
    $query = "UPDATE produits SET nom = '$nom', categorie = '$categorie',stock='$stock', prix = '$prix' WHERE nom = '$nom'";
    $result = $db->query($query);

    if($result){
        echo ' <script>  alert("Mise a jour réussie "); </script>';  } else{
        echo ' <script>  alert("⚠️⚠️⚠️ Échec de la mise à jour"); </script>';
    }
    exit;
}
elseif(isset($_POST['delete'])){
     $nom = $_POST['nom'];
    $query = "DELETE FROM produits WHERE nom = '$nom'";
    $result = $db->query($query);
    
    if($result){
        
        echo ' <script>  alert("✔️✔️✔️ Suppression réussie"); </script>';
        exit;
    } else {
        
        echo ' <script>  alert("⚠️⚠️⚠️ Échec de la suppression"); </script>';
    }
}

$db->close();
exit;
?>

</body>
</html>