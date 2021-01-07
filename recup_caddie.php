<?php
session_start();
    
    $sessionid=$_SESSION['sessionid'];
    if($sessionid=="") {
        $sessionid = session_id();
        $_SESSION[''.$sessionid.''];
    }
    
include("fonctions.php");

    $getBDD = getBDD(); // Connexion BDD récupéré dans fichier fonctions.php
    try {
        $requete = $getBDD->prepare('SELECT C.id, C.sessionid, C.qte, C.idprod, C.idclient, P.titre FROM caddie C, pizzas P WHERE C.idprod=P.id AND sessionid=:sessionid');
        $requete->execute(array(':sessionid' => $sessionid));
    
        while($resultat = $requete->fetch()) {
            echo "<li>".$resultat['qte']." x ".$resultat['titre']."</li>";
        }
    }
    catch(PDOException $e){
        die('Erreur ajax_recup : ' . $e->getMessage());
    } 
?>