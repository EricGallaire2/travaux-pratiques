<?php
session_start();
if($_SESSION['lasession']=="") {
    $lasession=session_id();
}
else {
    $lasession=$_SESSION['lasession'];
}

    require_once("fonctions/connexion.php");

    $connexion=connexion();
    $sql="SELECT C.product_id, C.qte, P.titre FROM newcaddie C, pizzas P WHERE C.product_id=P.id AND C.lasession='".$lasession."' ";
    $req = $connexion -> prepare ($sql);
    $req -> execute();
    while($resa = $req -> fetch()) {
    ?>
        <li><?= $resa['qte'] ?> x <?= $resa['titre'] ?></li>
    <?php 
    }


?>
