<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_notes');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
?>

<HTML> <!-- Balise de départ de la page HTML --> 
	 
	<HEAD> <!-- On met entre les balises HEAD le type de codage des caratères de la page et les liens vers les pages de syles ou de javascript--> 
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" /> <!-- type de codage des caractères --> 
		<title> Le pronote de Wish </title>
		<link rel="icon" href="unnamed.png">
		<link rel="stylesheet" href="style.css">  <!-- lien vers la page de style "style.css". On ne le met que s'il y a du CSS --> 
	</HEAD>
	<BODY>
	<nav>
      <ul class="menu">
		<li>
         Gestion des Notes
          <ul class="sub-menu">
            <li><a href="index.php">Insérer des notes dans Pronote de Wish ?</a></li>
			<li><a href="suppr.php">Suppression de Notes dans Pronote de Wish</a></li> 
          </ul>
        </li>
		<li>
           Visialisation des Notes
          <ul class="sub-menu">
            <li><a href="notes.php">Les notes des élèves</a></li>
			<li><a href="moyenne.php">Moyenes des élèves</a></li>
            <li><a href="bac.html">Moyenne au Bac</a></li>
          </ul>
        </li>
    </nav>
	<br> <br>
	<!-- C'est entre les balises BODY qu'on insère les objets de la page --> 
	<H1 align = "center"> Gestion de notes </h1><br> <br>
	<H2 align = "center"> Ajout d'une note :</h2><BR> <BR>
	<form method = "Post" action = "ajoutNotes.php" >
	<h3 align = "center">
	Elève : <select id = "eleve" name = "eleve">
	<?php
		$requete = "SELECT nom, ine, prenom FROM eleves;";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			echo"<option value='".$ele[1]."'>".$ele[2]." " .$ele[0]."</option>";
		}
	?></select>
	
	Matiere : <select id = "matiere" name = "matiere">
	<?php
		$requete = "SELECT nom, id FROM matieres;";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			echo "<option value='".$ele[1]."'>".$ele[0]."</option>";
		}
	?></select>
	
	Professeur : <select id = "professeur" name = "prof">
	<?php
		$requete = "SELECT nom, id FROM professeurs;";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			echo "<option value='".$ele[1]."'>".$ele[0]."</option>";
		}
	?></select>
	
	Note : <input type = "number" id = "note" name = "note"> </select>
	
	Coefficient : <input type = "number" id = "coef" name = "coef"> </select>
    <br> <br><input type = "submit" value = "envoyer">
	</form>
	</h3>
	</BODY>
</html>