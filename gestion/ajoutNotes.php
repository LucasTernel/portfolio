<?php
	$link_sql = mysqli_connect('localhost',
	'root', 'root', 'gestion_notes');
	if (!$link_sql) {
		die('Erreur de connection('.mysqli_connect_errno().')'.mysqli_connect_error());	
	}
	
	$requete ="INSERT INTO notes VALUES(NULL, ".$_POST['note'].", ".$_POST['matiere'].", "
			.$_POST['prof'].", '".$_POST['eleve']."', ".$_POST['coef'].");";
	mysqli_query($link_sql, $requete);
	header('Location: index.php')
?>
