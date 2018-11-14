<link rel="stylesheet" type="text/css" href="../css/articles.css">
<div class="articleComplet">
<?php
		$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');
		$req = $bdd->query("SELECT * FROM articles WHERE id=" . $_GET['id']);
		while ($donnees = $req->fetch()){
			$date = $donnees['date'];
			$titre = $donnees['titre'];
			$contenu = $donnees['contenu'];
			$array1 = array('&lt;', '&gt;', '&quot;', '&amp;', '&eacute;', '&#39;', '&egrave;', '&ccedil;', '&agrave;', '=&nbsp;');
			$array2 = array('<', '>', '"', '&', 'é', '\'', 'è', 'ç', 'à', '=');
			$contenuFinal = str_replace($array1, $array2, $contenu);
			echo "<div id='articleComplet'><span id='titreArticle'>" . $titre . " </span><span id='contenu'> " . $contenuFinal . "</span></div>";			
		}?>	
		<div class="blocCommentaire"><?php
			$req = $bdd->query("SELECT * FROM commentaires LEFT JOIN reponses ON reponses.idRep = commentaires.id WHERE idArticle=" . $_GET['id']);
			while ($donnees = $req->fetch()){
				echo "<div class='articleEtCom'><div id='commentaireArticle'<span id='auteur'><strong>" . $donnees['auteur'] . "</strong> " . $donnees['date'] . "</span></br><span id='contenuCom'> " . $donnees['contenu'] . "</span></div>";
				echo "<div id='responseCommentaire'><span id='auteurRep'><strong>" . $donnees['auteurRep'] . "</strong> " . $donnees['dateRep'] . "</span></br><span id='contenuRep'> " . $donnees['contenuRep'] . "</span></div></div>";
			}

			
		?></div><?php				
	?>	
</div>
<button><a href="../admin.php"> Accueil</a></button>
