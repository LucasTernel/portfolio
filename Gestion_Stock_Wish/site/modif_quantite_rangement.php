<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_stocks');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
?>

<HTML> <!-- Balise de départ de la page HTML -->  
	<HEAD> <!-- On met entre les balises HEAD le type de codage des caratères de la page et les liens vers les pages de syles ou de javascript--> 
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" /> <!-- type de codage des caractères --> 
		<title> Modifier le rangement / quantité dans le stock </title>
		<link rel="icon" href="img/unnamed.png">
		<link rel="stylesheet" href="style.css">  <!-- lien vers la page de style "style.css". On ne le met que s'il y a du CSS --> 
	</HEAD>
	<BODY>
	<nav>
      <ul class="menu">
	    <li>
           <a href="index.php">Acceuil</a></li>
        </li>
		<li>
         Gestion des stocks
          <ul class="sub-menu">
            <li><a href="creation_stock.php">Creer un nouveau stock</a></li>
			<li><a href="inserer_article.php">Insérer un nouvel article et ou rangement</a></li> 
			<li><a href="modif_quantite_rangement.php">Modifier la quantité ou rangement d'un article dans le stock</a></li> 
			
          </ul>
        </li>
		<li>
           Visialisation des stocks
          <ul class="sub-menu">
            <li><a href="stock.php">Affiche le stock de Wish</a></li>
          </ul>
        </li>
    </nav>
	<br> <br>
	<!-- C'est entre les balises BODY qu'on insère les objets de la page --> 
	<H1 align = "center"> Modifier la quantité d'un article dans le stock </h1><br> <br>
	<h3 align = "center">
	<form method = "Post" action = "modif_quantite_for.php" >
	Nom de l'article : <select id = "article" name = "article">
	<?php
		$requete = "SELECT nom, code FROM articles;";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			echo "<option value='".$ele[1]."'>".$ele[0]."</option>";
		}
	?></select>
	Quantite : <input type = "number" id = "quantite" name = "quantite"> </select>
    <br> <br><input type = "submit" value = "envoyer">
	</form>
	<br><br><br>
	<H1 align = "center"> Modifier le rangement d'un article dans le stock </h1><br> <br>
	<h3 align = "center">
	<form method = "Post" action = "modif_rangement_for.php" >
	Nom de l'article : <select id = "article" name = "article">
	<?php
		$requete = "SELECT nom, code prenom FROM articles;";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			echo "<option value='".$ele[1]."'>".$ele[0]."</option>";
		}
	?></select>
	 Nom du rangement : <select id = "rangement" name = "rangement"> 
	 <?php
		$requete = "SELECT nom, id FROM rangements;";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			echo "<option value='".$ele[1]."'>".$ele[0]."</option>";
		}
	?></select>
	 </select>
    <br> <br><input type = "submit" value = "envoyer">
	<br><br><br>
	<H1 align = "center"> Attention, il n'est possible de modifier qu'une valeur à la fois : soit on modifie la quantité du stock ou on modifie le rangement d'un article dans le stock </h1><br> <br>
	</form>
	</h3>
	</BODY>
</html>