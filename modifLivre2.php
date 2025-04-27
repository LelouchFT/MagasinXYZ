<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="logo.jpg">
	</head>
	<body>
		<nav >		
		<a href="index.php" >Accueil</a>
		<a href="rechLivres.html" >Rechercher</a>
		<a href="insertion.html" >Ajouter</a>
		<a href="rechAffichTab.html">Modif-affichage</a>
		<a href="modifLivre.html">Modif-simple</a>		
		<a href="authmain.php">MAGASIN</a> 
		<a href = "librairie/test.php">Voir Toutes les Commandes</a>
		
		</nav>
		<img src="logo.jpg">
		<h2>MAGASIN XYZ</h2>
<?php
require("variables.inc.php");
$nom = $_GET['nom'];
$categorie = $_GET['categorie'];
$stock = $_GET['stock'];
$prix = $_GET['prix'];

echo "<fieldset>
   <legend>MODIFICATION D'UN ARTICLE</legend>
<form action='' method='POST'>
    <table>
         <tr>
            <td>Nom de l article:</td>
            <td><input type='text' name='nomP' value='$nom' ></td>
         </tr>
         <tr>
            <td>Catégorie</td>
            <td><input type='text' name='cat' value='$categorie'></td>
         </tr>
        
         <tr>
            <td>Entrer le nombre de d article en stock :</td>
            <td><input type='number' name='qte' value='$stock'></td>
         </tr>
         <tr>
            <td>Entrer le prix unitaire :</td>
            <td><input type='number' name='pu' value='$prix'></td>
         </tr>
     </table>
     <input type='submit' name='update' value='Modifier'>
     <input type='submit' name='delete' value='Supprimer'>
</fieldset>
</form>";

if(isset($_POST['update'])){
    $nomP = $_POST['nomP'];
    $categorie = $_POST['cat'];
    
    $stock = $_POST['qte'];
    $prix = $_POST['pu'];

  /*  if(empty($isbn) || empty($auteur) || empty($titre) || empty($prix) || empty($stock)){ 
        echo '⚠️⚠️⚠️Veuillez remplir tous les champs';
    } else {
   */
        $db = new mysqli($bdsever, $bdlogin, $bdpwd, $bd);
        $query = "UPDATE produits SET nom= '$nomP', categorie = '$categorie', stock = '$stock', prix = '$prix' WHERE nom = '$nom'";
        $result = $db->query($query);

        if($result){
echo ' <script>  alert("✔️✔️✔️Mise à jour réussie "); </script>';

        } else {
            echo '⚠️⚠️⚠️Échec de la mise à jour. Réessayez';
        }
        $db->close();
    
} elseif(isset($_POST['delete'])) {
    $db = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
    $code = $_GET['nomP'];
    $query = "DELETE FROM produits WHERE nom = '$nom'";
    $result = $db->query($query);

    if($result){
        echo "✔️✔️✔️Suppression réussie<br><br>";
    } else {
        echo "⚠️⚠️⚠️Échec de la suppression";
    }
    $db->close();
}
if(isset($_POST['update']) || isset($_POST['delete'])){
$db = new mysqli($bdserver,$bdlogin,$bdpwd,$bd);
$query = "SELECT * FROM produits";
$result = $db->query($query);

$num_results = $result->num_rows;
if($num_results > 0){
    echo "<table border='1'>
         <tr><th>Nom Du produit</th><th>Catégorie</th><th>Quantité</th><th>Prix</th></tr>";
    while ($row = $result->fetch_assoc()) {
         $nom = $row['nom'];
        $categorie = stripslashes($row['categorie']);
        
        $stock = stripslashes($row['stock']); 
        $prix = stripslashes($row['prix']);
         echo "<tr><td>$nom</td>";
        echo "<td>$categorie</td>";
        
        echo '<td>' . $stock . '</td>';
        echo '<td>' . $prix . '</td></tr>';
    }
    echo "</table>";
}
else{ 
    
    echo ' <script>  alert("⚠️⚠️⚠️ Aucun article trouvé "); </script>';
}
$db->close();
}
?>
</body>
</html>