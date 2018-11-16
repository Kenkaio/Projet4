<?php
session_start();
?>

<!-- Ajout / Suppresion / Update de l'article sélectionné avec id -->

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
                        $_POST['idArt']
                    ));     
                    header('location:mesArticles.php?id=' . $_POST['idArt']);
                }

                if(isset($_POST['supprimer'])){
                    $req = $bdd->prepare('DELETE FROM articles WHERE id=?');
                    $req->execute(array($_POST['idArt']));
                    header('location:../admin.php');
                }

                if(isset($_POST['validerArticle'])){
                    $req = $bdd->prepare('INSERT INTO articles (titre, contenu) VALUES (:titre, :contenu)');
                    $req->execute(array(
                        'titre' => htmlspecialchars($_POST['titre']), 
                        'contenu' => htmlspecialchars($_POST['contenu'])
                    )); 
                    header('location:../admin.php');
                }

                if(isset($_POST['deleteCom'])){
                    $req = $bdd->prepare('DELETE FROM commentaires WHERE id=?');
                    $req->execute(array($_POST['deleteCom']));                    
                    header('location:mesArticles.php?id=' . $_POST['idArt']);
                }

                if(isset($_POST['deleteRep'])){
                    $req = $bdd->prepare('DELETE FROM reponses WHERE idR=?');
                    $req->execute(array($_POST['deleteRep']));
                    header('location:mesArticles.php?id=' . $_POST['idArt']);
                }

                if(isset($_POST['confirmEdit'])){
                    $req = $bdd->prepare('UPDATE commentaires SET contenu=? WHERE id=?');
                    $req->execute(array(
                        $_POST['contenuCom'],
                        $_POST['confirmEdit']
                    ));
                    header('location:mesArticles.php?id=' . $_POST['idArt']); 
                }

                if(isset($_POST['confirmRepEdit'])){
                    $req = $bdd->prepare('UPDATE reponses SET contenuRep=? WHERE idR=?');
                    $req->execute(array(
                        $_POST['contenuRep'],
                        $_POST['confirmRepEdit']
                    )); 
                    header('location:mesArticles.php?id=' . $_POST['idArt']);
                }
       		?>
    </div>    
</nav>