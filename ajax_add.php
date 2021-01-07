<?php 
session_start();

    if($_SESSION['lasession']=="") {
        $lasession=session_id();
    }
    else {
        $lasession=$_SESSION['lasession'];
    }


    require_once("fonctions/connexion.php");

    if($_POST['product_id']!="") {

        if($_POST['qte']<1) {
            $qte=1;
        }
        else {
            $qte=$_POST['qte'];
        }

        // Le produit est déjà dans mon caddie ou pas ?
        $connexion = connexion();
        $sql="SELECT id FROM newcaddie WHERE lasession='".$lasession."' AND product_id=:product_id";
        //echo $sql;
        $req = $connexion -> prepare($sql);
        $req -> execute(array(':product_id' => $_POST['product_id']));
        $res = $req->fetch(); 
        $id_a_verifier=$res['id'];

        $connexion = connexion();
        // Ajout ou modification de la ligne
        if ($id_a_verifier==true) { // Le produit est dan smon caddie
            $requete = $connexion -> prepare('UPDATE newcaddie SET qte = qte + '.$qte.' WHERE id='.$id_a_verifier.'');
            $requete -> execute();
        }
        else { // J'ajoute le produit à mon caddie
            $sql="INSERT INTO newcaddie (product_id, qte, lasession) VALUES (".$_POST['product_id'].", ".$qte.", '".$lasession."')";
            $requete = $connexion -> prepare($sql);
            $requete -> execute();
        }
    }

    if($_POST['vider']=="oui") {
        $connexion = connexion();
        $sql="DELETE FROM newcaddie WHERE lasession='".$lasession."'";
        $req = $connexion -> prepare($sql);
        $req -> execute();
    }
?>