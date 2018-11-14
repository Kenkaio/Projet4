<link rel="stylesheet" type="text/css" href="../css/admin.css">

<form action="connexion.php" method="POST" id="formCo">
	<img src="../images/logoCo.png" id="logoCo" alt="logo connexion">
	<h1>Sign in</h1>
	<label for="pseudo" name="pseudo" id="pseudo">Nom : </label><input type="text" name="pseudo">
	<label for="password" name="password" id="password">Mot de passe : </label><input type="password" name="password">
	<input type="submit" value="Confirmer" id="valider">
</form>

<?php
	/* ------- Vérification Connexion -------- */
	if (!isset($_POST['pseudo']) AND !isset($_POST['password'])) {
		
	}
	elseif (empty($_POST['pseudo']) OR empty($_POST['password'])) {
		echo "<div id='erreur'>Veuillez remplir tous les champs !</div>";
	}
	else{		
		$bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');
		$req = $bdd->prepare('SELECT * FROM admin WHERE pseudo= :pseudo');
		$req->execute(array(':pseudo' => $_POST['pseudo']));
		$result = $req->fetch();
		$Verif_Pass = password_verify($_POST["password"], $result["password"]);
		if (!$result) {
			echo "<div id='erreur'>Pseudo ou password incorrect !!! </div>";
		}
		else
		{
			if ($Verif_Pass) {
				session_start();
				$_SESSION['ouvert']='true'; 
				$_SESSION['id'] = $result['id'];
				$_SESSION['Pseudo'] = $result['Pseudo'];
				$_SESSION['Mail'] = $result['Mail'];

				header('location:../admin.php');
			}
			else{
				echo "<div id='erreur'>pseudo ou password incorrect</div>";
			}
		}
	}
?>