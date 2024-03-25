<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_notes');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
	
	$requete ="SELECT notes, id = 'eleve' FROM notes ";
	mysqli_query($link_sql, $requete);
	echo $requete;
?>
