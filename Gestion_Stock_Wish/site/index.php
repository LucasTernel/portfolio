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
		<title> Acceuil du stock </title>
		<link rel="icon" href="img/unnamed.png">
		<link rel="stylesheet" href="style.css">  <!-- lien vers la page de style "style.css". On ne le met que s'il y a du CSS --> 
	</HEAD>
	<body>
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
	<H1 align = "center"> Acceuil </h1><br> <br>
	<img  align = "center" src="img/stock.jpg" />
	</div>
	</BODY>
</html>