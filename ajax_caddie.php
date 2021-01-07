<?php 
session_start();
    require_once("fonctions/connexion.php");
    
    //echo "ajax_caddie";

    $sessionid=$_SESSION['sessionid'];
    if($sessionid=="") {
        $sessionid = session_id();
        $_SESSION[''.$sessionid.''];
    }
    
    /*
    echo "sessionid ".$sessionid."<BR>";
    echo "idproduit ".$_POST['idproduit']."<BR>";
    echo "qty ".$_POST['qty']."<BR>";
    */

    if($_POST['idproduit']!="" && $_POST['qty']!="" && $action=="") {
   
        

        $connexion = connexion(); // Connexion BDD récupéré dans fichier fonctions.php
        $sql='SELECT id FROM caddie WHERE sessionid =:sessionid AND idprod = :idproduit';
        echo "deja $deja $sql";
        $requete = $connexion->prepare($sql);
        $requete->execute(array(':sessionid' => $sessionid,':idproduit' => $_POST['idproduit']));
        $resultat = $requete->fetch();
        //$requete -> closeCursor();
        $deja=$resultat['id'];

        echo "deja $deja";

        $connexion = connexion();
        try {
            if($deja==true) {
                $sql="UPDATE caddie SET qte = qte + :qty WHERE idprod = :idproduit AND sessionid ='".$sessionid."' ";
                $requete = $connexion->prepare($sql);
                $requete->execute(array( ':qty' => $_POST['qty'], ':idproduit' => $_POST['idproduit']));
            }
            else {
            
                $sql="INSERT INTO caddie (idprod, qte, sessionid) VALUES (:idproduit, :qty, '$sessionid')";
                $requete = $connexion->prepare($sql);
                $requete->execute(array(':idproduit' => $_POST['idproduit'], ':qty' => $_POST['qty']));
            }
        }
        catch(PDOException $e){
            die('Erreur ajax_caddie : ' . $e->getMessage());
        } 
    }


    // Vide le panier
    if($sessionid!="" && $_POST['action']=="vider") {
        $connexion = connexion(); // Connexion BDD récupéré dans fichier fonctions.php
        try {
            $sql="DELETE FROM caddie WHERE sessionid='$sessionid'";
            echo "EFFACE ->  ".$sql."";
            $requete = $connexion->prepare($sql);
            $requete->execute();
        }
        catch(PDOException $e){
            die('Erreur ajax_caddie : ' . $e->getMessage());
        } 

    }

?>