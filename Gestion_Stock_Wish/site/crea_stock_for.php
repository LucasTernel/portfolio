<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_stocks');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
	
	$requete ="INSERT INTO stocks VALUES(NULL, '".$_POST['article']."', ".$_POST['rangement'].", "
			.$_POST['quantite'].")";
			
	mysqli_query($link_sql, $requete);
	header('Location: creation_stock.php')
?>
