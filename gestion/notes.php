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
            <li><a href="notes.php">Notes des élèves</a></li>
			<li><a href="moyenne.php">Moyenes des élèves</a></li>
            <li><a href="bac.php">Moyenne au Bac</a></li>
          </ul>
        </li>
    </nav>
	<br> <br>
	<!-- C'est entre les balises BODY qu'on insère les objets de la page --> 
	<H1 align = "center"><u> Notes des élèves </U></h1><br> <br>
	<h3> <U>Les Notes</U>
	<table border="1">
	<tr>
		<td>Nom</td><td>Prénom</td><td>Matière</td><td>Professeurs</td><td>Note</td><td> Coefficient </td>
	</tr><br><br>
	<?php
		$requete = "SELECT eleves.nom, eleves.prenom, matieres.nom AS matiere, professeurs.nom AS professeurs, note, coef FROM notes JOIN eleves ON eleves.ine = notes.eleves JOIN matieres ON matieres.id = notes.matiere JOIN professeurs ON professeurs.id = notes.professeur ORDER BY eleves.nom, eleves.prenom, matiere, professeurs, note, coef";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			$ligne = "<tr>";
			$ligne .= "<td>".$ele[0]."</td>";
			$ligne .= "<td>".$ele[1]."</td>";
			$ligne .= "<td>".$ele[2]."</td>";
			$ligne .= "<td>".$ele[3]."</td>";
			$ligne .= "<td>".$ele[4]."</td>";
			$ligne .= "<td>".$ele[5]."</td>";
			$ligne.= "</tr>";
			echo $ligne;
			
		}
	?>
	</table>
	</h3>
	</BODY>
</html>