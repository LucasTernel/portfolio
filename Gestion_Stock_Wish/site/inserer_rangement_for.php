<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_stocks');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
	
	$requete2 ="INSERT INTO rangements VALUES(NULL, '".$_POST['nom']."');";
	mysqli_query($link_sql, $requete2);
	header('Location: inserer_article.php')
	?>
	
