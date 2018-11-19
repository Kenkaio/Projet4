<!DOCTYPE html>
<html>
<head>
	<title>Mes chapitres</title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/chapitre.css">
	<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>	
	
	<div id="barNav">		
		<nav class="navbar">
			<ul class="nav navbar-nav">									
				<li><a href="../index.php" id="accueil">Accueil</a></li>
				<li><a href="#">Biographie</a></li>
				<li><a href="chapitres.php">Chapitres</a></li>
				<li><a href="../index.php#contact" id="lienContact">Contact</a></li>
			</ul>
		</nav>
	</div>
	
</head>
<body>
	<div class="contenuArticles">
		<?php 
			if (isset($_GET['id'])) {

				/*$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');*/
				$bdd = new PDO('mysql:host=db761958864.hosting-data.io;dbname=db761958864;charset=utf8', 'dbo761958864', 'Polo<555');
				$req = $bdd->query("SELECT * FROM articles WHERE id=" . $_GET['id']);
	        	$donnees = $req->fetch();
				if ($donnees['id'] == NULL) {
					header('location:chapitres.php');
				}
				else{
					$date = $donnees['date'];
					$titre = $donnees['titre'];
					$contenu = $donnees['contenu'];
					$array1 = array('&lt;', '&gt;', '&quot;', '&amp;', '&eacute;', '&#39;', '&egrave;', '&ccedil;', '&agrave;', '=&nbsp;');
					$array2 = array('<', '>', '"', '&', 'é', '\'', 'è', 'ç', 'à', '=');
					$contenuFinal = str_replace($array1, $array2, $contenu);
					echo "
						<div id='articleComplet'>
							<span id='titreArticle'>" . $titre . " </span></br></br>
							<span id='contenu'>" . $contenuFinal . "</span>
						</div>";
					echo "<h1 id='titreCom'>Commentaires: </h1>";	
					$req1 = $bdd->prepare("SELECT * FROM commentaires WHERE idArticle=? ORDER BY id DESC");
					$req1->execute(array($_GET['id']));
					while ($donnees1 = $req1->fetch()){
						$date = date_create($donnees1['date']);
						$echoDate = date_format($date, 'd-m-Y H:i:s');
						echo "
						<div class='contenuCom'>									
							<span id='auteur'>
								<strong>" . $donnees1['auteur'] . "</strong> " . $echoDate . "	
							</span></br>								
							<span id='contenuCom'> " . $donnees1['contenu'] . "</span></br>
							<input type='button' id='reponseCom" . $donnees1['id'] . "'  class='repondre' value='Répondre'></input>
							<form action='reception_fichier.php' method='post' enctype='multipart/form-data' id='formSignalementCom'>
								<input type='hidden' name='idSignalementCom' value='".$donnees1['id']."'></input>	
								<input type='hidden' name='idArt' value='".$_GET['id']."'></input>
								<input type='submit' class='signalerCom' name='signalerCom' value='Signaler'></input>
							</form>	
							<form action='reception_fichier.php' method='post' enctype='multipart/form-data' id='formArticle'>
								<input type='hidden' name='idCom' value='".$donnees1['id']."'></input>
								<input type='hidden' name='idArt' value='".$_GET['id']."'></input>
								<div id='editTextarea" . $donnees1['id']. "' class='editTextarea'>
									<input type='text' class='auteurRepCom' id='auteurRepCom' name='auteurRepCom'></input>
									<textarea for='reponseCom' name='reponseCom' id='reponseCom' rows='10'>Votre Commentaire</textarea></br>
									<input type='submit' class='confirmRepCom' name='confirmRepCom' value=".$donnees1['id']." '></input>
								</div>
							</form>
						</div>";
						$req2 = $bdd->prepare("SELECT * FROM reponses WHERE idArt=? ORDER BY idR DESC");
						$req2->execute(array($donnees1['id']));
						while ($donnees2 = $req2->fetch()){
							$date1 = date_create($donnees2['dateRep']);
							$echoDate1 = date_format($date1, 'd-m-Y H:i:s');
							echo "
							<div class='contenuRep'>									
								<span id='auteurRep'>
									<strong>" . $donnees2['auteurRep'] . "</strong> " . $echoDate1 . "</span>
									<form action='reception_fichier.php' method='post' enctype='multipart/form-data' id='formSignalementRep'>
										<input type='hidden' name='idSignalementCom' value='".$donnees2['idR']."'></input>	
										<input type='hidden' name='idArt' value='".$_GET['id']."'></input>
										<input type='submit' class='signalerRep' name='signalerRep' value='Signaler'></input>
									</form>					
								</br>									
								<span id='contenuRep'> " . $donnees2['contenuRep'] . "</span>
							</div>";
						}
					}
					echo "<h2>Ajout Commentaire</h2>";	
					?>
					<form action="reception_fichier.php" method="post" enctype='multipart/form-data' id='ajoutCommentaire'>
						<?php echo "	
							<input type='hidden' name='idArt' value='".$_GET['id']."'></input>"?>
							<input type="text" name="auteurCom" id="auteurCom">
							<textarea type="text" name="contenuCom" rows="10" id="contenuComText">Votre Message</textarea>
							<input type="submit" name="confirmerAjoutCom" id="confirmerAjoutCom">
					</form>
					<?php
				}					
			}
			else{
				/*$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');*/
				$bdd = new PDO('mysql:host=db761958864.hosting-data.io;dbname=db761958864;charset=utf8', 'dbo761958864', 'Polo<555');
				$req = $bdd->query("SELECT * FROM articles ORDER BY id DESC");
				while ($donnees = $req->fetch()){
					$date = $donnees['date'];
					$titre = $donnees['titre'];
					$contenu = $donnees['contenu'];
					$date = date_create($donnees['date']);
					$echoDate = date_format($date, 'd-m-Y H:i:s');
					$array1 = array('&lt;', '&gt;', '&quot;', '&amp;', '&eacute;', '&#39;', '&egrave;', '&ccedil;', '&agrave;', '=&nbsp;');
					$array2 = array('<', '>', '"', '&', 'é', '\'', 'è', 'ç', 'à', '=');
					$contenuFinal = str_replace($array1, $array2, $contenu);
					echo "

						<a href='chapitres.php?id=". $donnees['id'] ."'>
							<div id='article'>
								<div id='titreDate'><span id='titreArticle'>" . $titre . " </span><span id='date'>" . $echoDate . " </span></div>
								<span id='contenu'>" . $contenuFinal . "</span>
							</div>
						</a>";			
				}
			}
			
		?>
	</div>	
	<script src="../js/chapitre.js"></script>
</body>
</html>