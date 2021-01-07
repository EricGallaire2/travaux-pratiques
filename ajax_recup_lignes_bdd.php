<?php
    require("fonctions/connexion.php");

	if(isset($_POST['motcle'])) {
        $connexion = connexion(); // Connexion BDD récupéré dans fichier fonctions.php
        try {
            $requete = $connexion->prepare('SELECT * FROM pizzas WHERE titre LIKE :motcle');
            $requete ->execute(array(':motcle' => '%'.$_POST['motcle'].'%'));
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