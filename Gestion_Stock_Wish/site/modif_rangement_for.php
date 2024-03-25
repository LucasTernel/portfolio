<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_stocks');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
	
	$requete ="UPDATE stocks SET rangement = ".$_POST['rangement']." WHERE article ='".$_POST['article']."';";
	mysqli_query($link_sql, $requete);
	header('Location: modif_quantite_rangement.php')
	?>
