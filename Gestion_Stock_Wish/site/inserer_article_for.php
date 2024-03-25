<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_stocks');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
	
	$requete ="INSERT INTO articles VALUES('".$_POST['code']."','".$_POST['nom']."');";
	mysqli_query($link_sql, $requete);
	header('Location: inserer_article.php')
	?>
