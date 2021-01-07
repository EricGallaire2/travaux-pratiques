<?php 
    require_once("fonctions/connexion.php");

    if($_POST['nouvellevaleur']!="" && $_POST['ligne']!="") {
   
        $connexion = connexion(); // Connexion BDD récupéré dans fichier fonctions.php

        try {
            $sql="UPDATE test_ajax SET donnee = :nouvellevaleur WHERE ligne = :ligne";
            $requete = $connexion->prepare($sql);
            $requete->execute(array(':nouvellevaleur' => $_POST['nouvellevaleur'], ':ligne' => $_POST['ligne']));
        }
        catch(PDOException $e){
            die('Erreur ajax_maj : ' . $e->getMessage());
        } 
    }


?>