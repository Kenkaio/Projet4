<?php
session_start();
?>

<nav id="menu">        
    <div class="element_menu">
        <h3>Titre menu</h3>
            <?php 
            	        
                $bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');
                $req = $bdd->prepare('INSERT INTO articles (titre, contenu) VALUES (:titre, :contenu)');
                $req->execute(array(
                    'titre' => htmlspecialchars($_POST['titre']), 
                    'contenu' => htmlspecialchars($_POST['contenu'])
                )); 
                header('location:../admin.php');
            			?>
    </div>    
</nav>