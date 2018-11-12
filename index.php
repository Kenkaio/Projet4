<!DOCTYPE html>
<html>
<head>
	<title>Jean Forteroche</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/contact.css">
</head>
<body>
	<nav>
		<ul>									
			<li><a href="#">Accueil</a></li>
			<li><a href="#">Biographie</a></li>
			<li><a href="#">Chapitres</a></li>
			<li><a href="#contact" id="lienContact">Contact</a></li>
		</ul>
	</nav>

	<div class="container">

		<form id="contact" method="POST" action="contact.php">
			<h1>CONTACT</h1>
			<div>
				<input type="text" name="nom" id="nom">
				<input type="email" name="mail" id="mail">
			</div>
			<input type="text" name="subject" id="subject" required>
			<textarea type="text" name="message" id="message" required></textarea>
			<input type="submit" value="Envoyer" id="valider">
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>