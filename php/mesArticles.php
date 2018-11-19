<?php
session_start();
?>

<!-- Affiche l'article sélectionnée avec les commentaires -->

<!-- Ajout du script du textarea pour modification du contenu avec l'update -->

<!DOCTYPE html>
<html>
<head>
	<title>Mes articles</title>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0hkhpc4x9cs6zila14oyvwobq0nvvwt8jz83d0b6k58i1q6s"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/articles.css">
</head>
<body>
	<div class="articleComplet">
	<!-- Création formulaire qui envoi a 'reception fichier.php' afin de traiter la demande -->
		<form action="reception_fichier.php" method="post" enctype="multipart/form-data" id="formArticleAdmin">
			<input type='hidden' name='idArt' value='<?php echo "".$_GET['id']."" ?>'></input>
		<?php
			/*$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');*/
			$bdd = new PDO('mysql:host=db761958864.hosting-data.io;dbname=db761958864;charset=utf8', 'dbo761958864', 'Polo<555');
	        $req = $bdd->query("SELECT * FROM articles WHERE id=" . $_GET['id']);
	        $donnees = $req->fetch();
	        if ($donnees) { 
		        /*$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');*/
				$bdd = new PDO('mysql:host=db761958864.hosting-data.io;dbname=db761958864;charset=utf8', 'dbo761958864', 'Polo<555');
				$req = $bdd->query("SELECT * FROM articles WHERE id=" . $_GET['id']);
				while ($donnees = $req->fetch()){
					$date = $donnees['date'];
					$titre = $donnees['titre'];
					$contenu = $donnees['contenu'];
					/* --- array 1 et remplacé par array 2 dans le contenu afin d'afficher le contenu sous forme html ----- */
					$array1 = array('&lt;', '&gt;', '&quot;', '&amp;', '&eacute;', '&#39;', '&egrave;', '&ccedil;', '&agrave;', '=&nbsp;');
					$array2 = array('<', '>', '"', '&', 'é', '\'', 'è', 'ç', 'à', '=');
					$contenuFinal = str_replace($array1, $array2, $contenu);
					echo "<textarea for='contenuArt' name='contenuArt' id='contenuArt' class='ckeditor' style='height: 40em'>" . $contenuFinal . "</textarea>";		
				}?>	
				<input type="submit" name="update" id="update">
				<input type="submit" name="supprimer" id="supprimer">
		</form>
			<!-- Récupération des commentaires de chaques articles et des reponses de chaques commentaires (LEFT JOIN permet la jointure) -->
			<div class="blocCommentaire">
				<?php
					$req = $bdd->prepare("SELECT * FROM commentaires WHERE idArticle=? ORDER BY id DESC"); // Affiche les commentaires
					$req->execute(array($_GET['id']));
					while ($donnees = $req->fetch()){
						$date = date_create($donnees['date']);
						$echoDate = date_format($date, 'd-m-Y H:i:s');						
						echo "
							<form action='reception_fichier.php' method='post' enctype='multipart/form-data' id='formArticleAdmin'>
								<input type='hidden' name='idArt' value='".$_GET['id']."'></input>
								<div class='articleEtCom'>
									<div id='commentaireArticle'>
										<span id='auteur" . $donnees['id']. "' class='auteur'>
											<strong>" . $donnees['auteur'] . "</strong> " . $echoDate . "
											<input type='submit' class='deleteCom' name='deleteCom' value=".$donnees['id']." '></input>
											<button class='edit' value=" . $donnees['id']. " onclick='return false'></button>
										</span></br>									
										<span id='contenuCom" . $donnees['id']. "' class='contenuCom'> " . $donnees['contenu'] . "</span>
										<div id='editTextarea" . $donnees['id']. "' class='editTextarea'>
											<textarea for='contenuCom' name='contenuCom' id='contenuCom' class='ckeditor'>
												" . $donnees['contenu']. "									
											</textarea></br>
											<input type='submit' class='confirmEdit' name='confirmEdit' value=".$donnees['id']." '></input>
										</div>
									</div>
								</div>
							</form>";
						$req1 = $bdd->prepare("SELECT * FROM reponses WHERE idArt=? ORDER BY idR DESC"); //Affiche les réponses des commentaires
						$req1->execute(array($donnees['id']));
						while ($donnees1 = $req1->fetch()){
							echo "
							<form action='reception_fichier.php' method='post' enctype='multipart/form-data' id='formArticleAdmin'>
								<input type='hidden' name='idArt' value='".$_GET['id']."'></input>
								<div id='responseCommentaire'>
									<span id='auteurRep" . $donnees1['idR']. "' class='auteurRep'>
										<strong>" . $donnees1['auteurRep'] . "</strong> " . $donnees1['dateRep'] . "
										<input type='submit' class='deleteCom' name='deleteRep' value=".$donnees1['idR']." '></input>
										<button class='editRep' value=" . $donnees1['idR']. " onclick='return false'></button>
									</span></br>
									<span id='contenuRep" . $donnees1['idR']. "' class='contenuRep'> " . $donnees1['contenuRep'] . "</span>
									<div id='editRepTextarea" . $donnees1['idR']. "' class='editTextarea'>
											<textarea for='contenuRep' name='contenuRep' id='contenuRep' class='ckeditor'>
												" . $donnees1['contenuRep']. "									
											</textarea></br>
											<input type='submit' class='confirmEdit' name='confirmRepEdit' value=".$donnees1['idR']." '></input>
										</div>
								</div>	
							</form>";				
						}
					}
				?>			
			</div>
			<?php
			}
	        else{
	        	header('location:../admin.php');
	        }			
		?>				
	</div>
	<a href="../admin.php"><button id="accueilArticle"></button></a>
	<script src="../js/article.js"></script>
</body>
</html>		
