<!DOCTYPE html>
<html>
	<head>
		<title>MAGASIN XYZ</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="logo.jpg">
	</head>
	<body>
      <img src="logo.jpg">
 	  <h2>MAGASIN XYZ</h2>	
		
	  <nav>		
		<a href="liste_produit.php" >Accueil</a>
		<a href="rechLivres.html" >Rechercher</a>
		<a href="insertion.html" >Ajouter</a>
		<a href="rechAffichTab.html">Modif-affichage</a>
		<a href="modifLivre.html">Modif-simple</a>		
		<a href="authmain.php">MAGASIN</a> 
		<a href = "librairie/cmd_all.php">Voir Toutes les Commandes</a>
		
   	  </nav>
		
		
      <p class="text"align="center">Bienvenue au Magasin XYZ</p>  
 	  <p class="text" align="center">Liste des articles disponibles</h2>
      <?php
         require("variables.inc.php");
         $db = new mysqli($bdserver,$bdlogin,$bdpwd,$bf);
         $query = "SELECT * FROM produits";
         $result = $db->query($query);

         $num_results = $result->num_rows;
         if($num_results > 0){
            echo "<table align='center' border='1'>
               <tr><th>N°</th><th>Nom</th><th>Categorie</th><th>Stock</th><th>Prix</th></tr>";
            $i=1;
            
            while ($row = $result->fetch_assoc()) {      
               $nom = stripslashes($row['nom']);
               $categorie = stripslashes($row['categorie']);
               $stock = stripslashes($row['stock']); 
               $prix = stripslashes($row['prix']);
               echo "<tr><td>$i</td>";
               echo "<td>$nom</td>";
               echo "<td>$categorie</td>";
               echo "<td>$stock</td>";
               echo '<td>' . $prix . '</td>';              
               $i++;
           }
           echo "</table>";
        }
        else{ 
           echo 'Aucun produits en rayon';
        }
        $db->close();
     ?>
   </body>
</html>