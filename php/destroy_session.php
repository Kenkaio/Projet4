<!-- Quand clique sur deconnecté, destruction de la session + redirection connexion.php -->

<?php 
session_start();

$_SESSION = array();
session_destroy();

header('location:connexion.php');