<div id="mesArticles">
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');
        /*$bdd = new PDO('mysql:host=db761051409.hosting-data.io;dbname=db761051409;charset=utf8', 'dbo761051409', 'amelie33');*/
		$req = $bdd->query("SELECT * FROM articles ORDER BY id DESC");
		while ($donnees = $req->fetch()){
			$date = $donnees['date'];
			$titre = $donnees['titre'];
			$contenu = $donnees['contenu'];
			$array1 = array('&lt;', '&gt;', '&quot;', '&amp;', '&eacute;', '&#39;', '&egrave;', '&ccedil;', '&agrave;', '=&nbsp;');
			$array2 = array('<', '>', '"', '&', 'é', '\'', 'è', 'ç', 'à', '=');
			$contenuFinal = str_replace($array1, $array2, $contenu);
			echo "<a href='php/mesArticles.php?id=". $donnees['id'] ."'>'<div id='article'><span id='titreArticle'>" . $titre . " </span><span id='contenu'> " . $contenuFinal . "</span></div></a>";			
		}					
	?>	
</div>
