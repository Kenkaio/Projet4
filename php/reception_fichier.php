<?php
session_start();
?>

<nav id="menu">        
    <div class="element_menu">
        <h3>Titre menu</h3>
            <?php 

                $bdd = new PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');

                if (empty($_SESSION['ouvert']))  {
                    header('location:connexion.php');
                }

                if(isset($_POST['update'])){                    
                    $req = $bdd->prepare('UPDATE articles SET contenu=? WHERE id=?');
                    $req->execute(array(
                        htmlspecialchars($_POST['contenuArt']),
                        $_POST['id']
                    )); 
                }

                if(isset($_POST['supprimer'])){
                    $req = $bdd->prepare('DELETE FROM articles WHERE id=?');
                    $req->execute(array($_POST['id']));
                }

                if(isset($_POST['validerArticle'])){
                    $req = $bdd->prepare('INSERT INTO articles (titre, contenu) VALUES (:titre, :contenu)');
                    $req->execute(array(
                        'titre' => htmlspecialchars($_POST['titre']), 
                        'contenu' => htmlspecialchars($_POST['contenu'])
                    )); 
                }
                header('location:../admin.php');
       		?>
    </div>    
</nav>