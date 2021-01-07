<?php 
    /**
    * name Affichage de la liste des pizzzas pour l'API
    * @param aucun paramètre
     */
    class AffPizza {
        public $id;
        public $titre;
        public $ingredients;
        public $pv_ttc;

        public function  __construct($id, $titre, $ingredients, $pv_ttc) {
            $this->id = $id;
            $this->titre = $titre;
            $this->ingredients = $ingredients;
            $this->pv_ttc = $pv_ttc;
        }
    }

    require_once("fonctions/connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Créer du JSON";
include("_head.php");
?>
<body>
<?php 
include("_navbar.php");
?>

    <div class="container-fluid">
        <h1 class="text-center"><?= $titrepage ?></h1>
        <?php 
        $connexion = connexion();
        $sql="SELECT * FROM pizzas";
        $requete = $connexion->prepare($sql);
        $requete->execute();
        $tab="<table class=\"table table-striped\">";
        $tab.="<thead>";
        $tab.="<th colspan=\"4\">Liste des produits en base de données</th>";
        $tab.="</thead>";
        while ($res = $requete->fetch()) {

            $id=$res['id'];
            $titre=$res['titre'];
            $ingredients=$res['ingredients'];
            $pv_ttc=$res['pv_ttc'];

            $tab.="<tr>";
            $tab.="<td>$id</td>";
            $tab.="<td>$titre</td>";
            $tab.="<td>$ingredients</td>";
            $tab.="<td>$pv_ttc</td>";
            $tab.="</tr>";

            $liste[] = new AffPizza($id, $titre, $ingredients, $pv_ttc);
        }
        //var_dump($liste[2]);
        $tab.="</table>";
        //header('Content-Type: application/json'); // Forcer l'affichage en JSON
        $donnee_json= json_encode($liste, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT);
        //echo $donnee_json;
        //die();
        ?>
        <div class="alert alert-success" id="monjson" style="display:none;"><?= $donnee_json ?></div>


        <div class="m-2 bg-white" id="montableau" style=""><?= $tab ?></div>
        <a onclick="$('#monjson').slideToggle(3000);$('#montableau').slideToggle(1000);$('#moncode').slideToggle(2000);" class="btn btn-success  m-5">Afficher</a>
        <div class="m-2 bg-white" id="moncode" style="display:none;">
        <code>
        <pre class="text-secondary p-2" style="font-size:20px;">
// La classe qui prépare l'affichage des résultats en couple "clé : valeur"
    class AffPizza {
        public $id;
        public $titre;
        public $ingredients;
        public $pv_ttc;

        public function  __construct($id, $titre, $ingredients, $pv_ttc) {
            $this->id = $id;
            $this->titre = $titre;
            $this->ingredients = $ingredients;
            $this->pv_ttc = $pv_ttc;
        }
    }

// la requete vers la Base de données
    (...... new PDO ... etc......)
    while ($res = $requete->fetch()) {
        $liste[] = new AffPizza($res['id'], $res['titre'], $res['ingredients'], $res['pv_ttc']);
    }

// la préparation à l'encodage
    //header('Content-Type: application/json'); // Forcer l'affichage en JSON
    $donnee_json = json_encode($liste, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT);
    //die();
    echo $donnee_json;
        </pre>
        </code>
        </div>
    </div>
<?php 
include("_footer.php");
?>
</body>
</html>