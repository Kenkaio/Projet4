<?php
session_start();
?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0hkhpc4x9cs6zila14oyvwobq0nvvwt8jz83d0b6k58i1q6s"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<link rel="stylesheet" type="text/css" href="../css/articles.css">
<div class="articleComplet">
	<form action="reception_fichier.php" method="post" enctype="multipart/form-data" id="formArticleAdmin">
		<input type="hidden" name="id" value="<?php echo "".$_GET['id']."" ?>"></input>
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
			echo "<textarea for='contenuArt' name='contenuArt' id='contenuArt' class='ckeditor' style='height: 40em'>" . $contenuFinal . "</textarea>";			
		}?>	
		<input type="submit" name="update" id="update">
		<input type="submit" name="supprimer" id="supprimer">
	</form>
		<div class="blocCommentaire"><?php
			$req = $bdd->query("SELECT * FROM commentaires LEFT JOIN reponses ON reponses.idRep = commentaires.id WHERE idArticle=" . $_GET['id']);
			while ($donnees = $req->fetch()){
				echo "<div class='articleEtCom'><div id='commentaireArticle'<span id='auteur'><strong>" . $donnees['auteur'] . "</strong> " . $donnees['date'] . "</span></br><span id='contenuCom'> " . $donnees['contenu'] . "</span></div>";
				echo "<div id='responseCommentaire'><span id='auteurRep'><strong>" . $donnees['auteurRep'] . "</strong> " . $donnees['dateRep'] . "</span></br><span id='contenuRep'> " . $donnees['contenuRep'] . "</span></div></div>";
			}			
		?></div><?php				
	?>	
		
</div>
<a href="../admin.php"><button id="accueilArticle"></button></a>
