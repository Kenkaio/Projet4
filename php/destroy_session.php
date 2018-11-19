<?php
ob_start();
function redirect_to($url){
    header($url);
    exit();
}

/*Quand clique sur deconnecté, destruction de la session + redirection connexion.php*/
 
session_start();
 
$_SESSION = array();
session_destroy();
 
redirect_to('Location:connexion.php');

ob_end_flush();