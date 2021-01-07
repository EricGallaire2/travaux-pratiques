<?php 
    require_once("fonctions/connexion.php");

    $connexion = connexion(); // Connexion BDD récupéré dans fichier fonctions.php
    try {
        $requete = $connexion->prepare('SELECT donnee FROM test_ajax WHERE ligne = :ligne');
        $requete->execute(array(':ligne' => $_GET['ligne']));
    
        $resultat = $requete->fetch();
        echo  $resultat['donnee'];
    }
    catch(PDOException $e){
        die('Erreur ajax_recup : ' . $e->getMessage());
    } 
?>