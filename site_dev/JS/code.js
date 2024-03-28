var MajeurouMineur = function(){
	age_utilisateur = document.getElementById("age").value;
	if(age_utilisateur >= 18)
	{
		document.getElementById("reponse").innerHTML="Vous êtes Majeur"
	}
	else
	{
		document.getElementById("reponse").innerHTML="Vous êtes Mineur"
	}
	
}
var ChangerCouleur= function() {
	composanteRouge = parseInt(document.getElementById("rouge").value);
	composanteVerte = parseInt(document.getElementById("vert").value);
	composanteBleue = parseInt(document.getElementById("bleu").value);
	document.getElementById("DS4-1").style.backgroundColor='rgb(' + composanteRouge + ',' + composanteVerte + ',' + composanteBleue + ')';
}

var EvaluerQuizz= function() {
	if(document.getElementById("choix2").checked)
	{
		document.getElementById("evaluation").innerHTML="Bravo !" 
	}
	else
	{
		document.getElementById("evaluation").innerHTML="Non c'etait Blaise Pascal"
	}
}
