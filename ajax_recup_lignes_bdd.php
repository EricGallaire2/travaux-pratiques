<?php
    require("fonctions/connexion.php");

	if(isset($_POST['motcle'])) {
        //$getBDD = connexion(); // Connexion BDD récupéré dans fichier fonctions.php
        try {
            $connexion= new PDO ("mysql:host=".HOST.";dbname=".BDD.";charset=utf8", USER, PASSW, array(PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION));
            $requete = $connexion->prepare('SELECT * FROM pizzas WHERE titre LIKE :motcle');
            $requete ->execute(array(':motcle' => '%'.$_POST['motcle'].'%'));
            /*
            $motcle=$_POST['motcle'];
            $motcle=addslashes("$motcle"); // j\'espère contaire stripslashes("$motcle");
            $requete = $connexion->prepare("SELECT * FROM pizzas WHERE titre LIKE '%$motcle%'");
            $requete->execute();
            */
            while($res = $requete->fetch() ) {
                ?>
                <button onclick="recup_titre('<?= $res['titre'] ?>'); affiche_ingredients('<?= addslashes($res['ingredients']) ?>');" class="btn btn-info btn-block">
                <?= $res['titre'] ?> : <?= $res['ingredients'] ?>
                </button>
                <?php
            }
        }
        catch(PDOException $e){
            die('Erreur ajax_recup : ' . $e->getMessage());
        } 
	}
	else {
		echo '<BR/>L\'accès direct au script est interdit !';
	}
?>