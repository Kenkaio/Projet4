<?php

	/*$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');*/
	$bdd = new PDO('mysql:host=db761958864.hosting-data.io;dbname=db761958864;charset=utf8', 'dbo761958864', 'Polo<555');
	$req = $bdd->query("SELECT * FROM articles ORDER BY id DESC");
	while ($donnees = $req->fetch()){
		$array1 = array('&lt;', '&gt;', '&quot;', '&amp;', '&eacute;', '&#39;', '&egrave;', '&ccedil;', '&agrave;', '=&nbsp;');
		$array2 = array('<', '>', '"', '&', 'é', '\'', 'è', 'ç', 'à', '=');
		$contenuFinal = str_replace($array1, $array2, $donnees['contenu']);
		$date = date_create($donnees['date']);
		$echoDate = date_format($date, 'd-m-Y H:i:s');
		$req1 = $bdd->query("SELECT * FROM commentaires WHERE idArticle =".$donnees['id']);
		$row = $req1->rowCount();
		echo "
		<script>
			var table = document.getElementById('tableArticle');
			table.insertAdjacentHTML('beforeend', '<tr><td class=\'id\'><a href=\'php/mesArticles.php?id=". $donnees['id'] ."\'>".$donnees['id']."</a></td><td>".$echoDate."</td><td>".$donnees['titre']."</td><td>".$row."</td></tr>');
		</script>";
	}