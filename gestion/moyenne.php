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
			<li><a href="moyenne.php">Moyenes des élèves et bac</a></li>
          </ul>
        </li>
    </nav>
	<br> <br>
	<!-- C'est entre les balises BODY qu'on insère les objets de la page --> 
	<H1 align = "center"><u> Notes des élèves </U></h1><br> <br>
	<h3> <U>La moyenne :</U>
	<table border="1">
	<tr>
	<h1>Calcul de la Moyenne de l'Élève</h1>

    <form action="" method="post">
        <label for="eleve">Choisir un élève :</label>
        <select id = "eleve" name = "eleve">
<?php
// Traitement du formulaire lorsqu'un élève est sélectionné
if (isset($_POST['eleve_ine'])) {
    $eleve_id = $_POST['eleve_ine'];

    // Query pour récupérer les notes de l'élève
    $requete_notes = "SELECT matieres.nom AS matiere, note, coef
                      FROM notes
                      JOIN matieres ON notes.matiere = matieres.id
                      WHERE notes.eleves = '$eleve_id'";

    $result_notes = mysqli_query($link_sql, $requete_notes);

    // Vérifier les erreurs de requête
    if (!$result_notes) {
        die('Error in SQL query: ' . mysqli_error($link_sql));
    }

    // Tableau pour stocker les notes de l'élève
    $notes_table = array();

    while ($row = mysqli_fetch_assoc($result_notes)) {
        $notes_table[] = $row;
    }

    // Calculer la moyenne
    $total_points = 0;
    $total_coef = 0;

    foreach ($notes_table as $note) {
        $total_points += $note['note'] * $note['coef'];
        $total_coef += $note['coef'];
    }

    $moyenne = ($total_coef > 0) ? round($total_points / $total_coef, 2) : 0;

    // Afficher le tableau des notes et la moyenne
    echo "<h2>Informations de l'élève</h2>";
    echo "<h3>Notes de l'élève</h3>";
    echo "<table border='1'>
            <tr>
                <th>Matière</th>
                <th>Note</th>
                <th>Coef</th>
            </tr>";
    
    foreach ($notes_table as $note) {
        echo "<tr>
                <td>{$note['matiere']}</td>
                <td>{$note['note']}</td>
                <td>{$note['coef']}</td>
              </tr>";
    }

    echo "</table>";

    echo "<h3>Moyenne: $moyenne</h3>";
}

// Formulaire pour sélectionner l'élève
echo "<h1>Calcul de la Moyenne de l'Élève</h1>";
echo "<form action='' method='post'>";
echo "<label for='eleve_id'>Choisir un élève :</label>";
echo "<select id='eleve_id' name='eleve_id'>";

// Récupérer la liste des élèves depuis la base de données
$requete_eleves = "SELECT ine, nom, prenom FROM eleves";
$result_eleves = mysqli_query($link_sql, $requete_eleves);

// Vérifier les erreurs de requête
if (!$result_eleves) {
    die('Error in SQL query: ' . mysqli_error($link_sql));
}

while ($row = mysqli_fetch_assoc($result_eleves)) {
    echo "<option value='{$row['ine']}'>{$row['nom']} {$row['prenom']}</option>";
}

echo "</select>";
echo "<input type='submit' value='Afficher les informations'>";
echo "</form>";

// Afficher le tableau des résultats
echo "<h3>Résultats</h3>";
echo "<table border='1'>
        <tr>
            <th>Matière</th>
            <th>Moyenne</th>
            <th>Coefficient</th>
            <th>Point pour le bac</th>
        </tr>";

$requete1 = "SELECT matieres.nom AS matiere, AVG(note * notes.coef) / AVG(notes.coef) AS moyenne_totale_ponderee, matieres.coefficient, (AVG(note * notes.coef) / AVG(notes.coef) * matieres.coefficient) AS moyenne_matieres_bac FROM notes JOIN matieres ON notes.matiere = matieres.id WHERE notes.eleves = '081534255GF' GROUP BY matiere";

$result = mysqli_query($link_sql, $requete1);
while ($ele = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$ele['matiere']}</td>
            <td>{$ele['moyenne_totale_ponderee']}</td>
            <td>{$ele['coefficient']}</td>
            <td>{$ele['moyenne_matieres_bac']}</td>
          </tr>";
}

echo "</table>";
?>
<input type="submit" value="Afficher la moyenne">
		</select> <br>
    </form>
		<td>Eleve</td><td>Matiere</td><td>Moyenne</td><td>Coefficient</td><td>Point pour le bac</td>
	</tr><br><br>
	<?php
		$requete1  = "SELECT matieres.nom AS matiere, AVG(note * notes.coef) / AVG(notes.coef) AS moyenne_totale_ponderee, matieres.coefficient, (AVG(note * notes.coef) / AVG(notes.coef) * matieres.coefficient) AS moyenne_matieres_bac FROM notes JOIN matieres ON notes.matiere = matieres.id WHERE notes.eleves = '081534255GF' GROUP BY matiere";
		$result = mysqli_query($link_sql, $requete1);
		while($ele = mysqli_fetch_row($result)){
			$ligne = "<tr>";
			$ligne .= "<td>".$ele[0]."</td>";
			$ligne .= "<td>".$ele[1]."</td>";
			$ligne .= "<td>".$ele[2]."</td>";
			$ligne .= "<td>".$ele[3]."</td>";
			$ligne.= "</tr>";
			echo $ligne;
			
		}
	?>
	</table>
	<br> <br> <br> */
<h3> <U>Obtention du bac ?</U>
	<table border="1">
	<tr>
		<td>Baccalauréat</td>
	</tr><br><br>
	<?php
		$requete = "SELECT  
                 CASE 
                     WHEN SUM(moyenne_matieres_bac) >= 1000 THEN 'Obtenu avec mention Très Bien' 
                     WHEN SUM(moyenne_matieres_bac) >= 600 THEN 'Obtenu avec mention Bien' 
                     WHEN SUM(moyenne_matieres_bac) >= 400 THEN 'Obtenu avec mention Assez Bien' 
                     ELSE 'Non Obtenu' 
                 END AS resultat 
             FROM (
                 SELECT 
                     matieres.nom AS matiere, 
                     AVG(note * notes.coef) / AVG(notes.coef) AS moyenne_totale_ponderee, 
                     matieres.coefficient, 
                     AVG(note * notes.coef) / AVG(notes.coef) * matieres.coefficient AS moyenne_matieres_bac 
                 FROM 
                     notes 
                     JOIN matieres ON notes.matiere = matieres.id 
                 WHERE 
                     notes.eleves = '081534255GF' 
                 GROUP BY 
                     matiere
             ) AS sous_requete";
		$result = mysqli_query($link_sql, $requete);
		while($ele = mysqli_fetch_row($result)){
			$ligne = "<tr>";
			$ligne .= "<td>".$ele[0]."</td>";
			$ligne.= "</tr>";
			echo $ligne;
		}
	?>
	</table>
	</h3>
	</BODY>
</html>