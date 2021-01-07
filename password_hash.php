<?php
    require_once("fonctions/connexion.php");

    $salt="cou!cou";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if($_POST['action']=="create" && $_POST['identif']!="" && $_POST['lepassword']!="") {
        //echo "Insertion<BR>";
   
        $connexion= connexion();
        $requete = $connexion->prepare("INSERT INTO passwhash (identif, mdp, normal) VALUES (:identif, :lepassword, :normal)");
        $lepassword = password_hash($_POST['lepassword'].'$salt', PASSWORD_BCRYPT);
        $requete->execute(array(
            ':identif' => $_POST['identif'], 
            ':lepassword' => $lepassword,
            ':normal' => $_POST['lepassword']
            ));
    }


    if($_POST['action']=="recup" && $_POST['identif']!="" && $_POST['lepassword']!="") {

        $connexion= connexion();
        $requete=$connexion->prepare('SELECT * FROM passwhash WHERE identif=:identif');
        $requete->execute(array(':identif' => $_POST['identif']));
       
        $resultat = $requete->fetch();
        if(password_verify($_POST['lepassword'].'$salt', $resultat['mdp'])) { 
            echo "<a href=\"password_hash.php\">ok... Recommencer</a>";
            // Ajouter la session
            // AJouter le cookie
            // header('location:kkkkk');
            exit();
        } 
        else {
            $alert="<div class=\"alert alert-danger\">Erreur de combinaison </div>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Utilisation password_hash / password_verify";
include("_head.php");
?>
<body>
<?php 
include("_navbar.php");
?>
    <div class="container-fluid">
        <h1 class="text-center">Combinaison <strong class="text-secondary">password_hash / password_verify</strong><BR>avec le salt  "<?= $salt ?>"<BR>et le cryptage  "PASSWORD_BCRYPT"</h1>
        <div class="row">
            <div class="col m-2 p-2 border bg-light">
                <h2>Création d'une combinaison</h2>
                <form action="password_hash.php" method="POST">
                <input type="hidden" name="action" value="create">
                <input type="text" name="identif" class="form-control" placeholder="Choisir un login">
                <input type="text" name="lepassword" class="form-control" placeholder="Choisir un mot de passe">
                <button class="btn btn-warning btn-block">Create</button>
                </form>
            </div>
            <div class="col m-2 p-2 border bg-light">
                <h2>Vérification de la combinaison</h2>
                <?= $alert!='' ? $alert : '' ?>
                <form action="password_hash.php" method="POST">
                <input type="hidden" name="action" value="recup">
                <input type="text" name="identif" class="form-control" placeholder="Indiquez votre login">
                <input type="text" name="lepassword" class="form-control" placeholder="Indiquez votre mot de passe">
                <button class="btn btn-success btn-block">Vérif</button>
                </form>
            </div>
        </div>
        <a href="javascript:;" onclick="$('#codesource').slideToggle();" class="btn btn-block btn-secondary">Voir le code source</a>
        <div class="row" id="codesource" style="display:none;">
            <div class="col m-2 p-2 border bg-light">
                <pre class="text-secondary">
                <code>
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $salt="cou!cou";

        if($_POST['action']=="create" && $_POST['identif']!="" && $_POST['lepassword']!="") {
    
            $db= new PDO("mysql:host=".HOST.";dbname=".BDD.";charset=utf8mb4", USER, PASSW, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $requete = $db->prepare("INSERT INTO nomdelatable (identif, mdp, normal) VALUES (:identif, :lepassword, :normal)");
            $lepassword = password_hash($_POST['lepassword'].'$salt', PASSWORD_BCRYPT);
            $requete->execute(array(
                ':identif' => $_POST['identif'], 
                ':lepassword' => $lepassword,
                ':normal' => $_POST['lepassword'] 
                ));
        }

        if($_POST['action']=="recup" && $_POST['identif']!="" && $_POST['lepassword']!="") {

            $db= new PDO("mysql:host=".HOST.";dbname=".BDD.";charset=utf8mb4", USER, PASSW, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $requete=$db->prepare('SELECT * FROM nomdelatable WHERE identif=:identif ');
            $requete->execute(array(':identif' => $_POST['identif']));
        
            $resultat = $requete->fetch();
            if(password_verify($_POST['lepassword'].'$salt', $resultat['mdp'])) { 
                // Ajouter la session
                // AJouter le cookie
                // header('location:kkkkk');
                exit();
            } 
            else {
                echo "&lt;LI&gt;Erreur de combinaison &lt;/li&gt;";
            }
        }
    }
                </code>
                </pre>
            </div>
        </div>
    </div>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <?php 
    if(isset($_POST['lepassword'])) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-5 m-2 p-2 bg-light text-secondary">
                <h2>.htaccess</h2>
                <?php 
                $chemin = getcwd();
                echo "$chemin/"; 
                ?>
            </div>
            <div class="col-7 m-2 p-2 bg-light text-secondary">
                <h2>.htpasswd généré pour ce mot de passe</h2>
                <?php 
                    if($_POST['lepassword']!="")
                    echo password_hash(''.$_POST['lepassword'].'', PASSWORD_BCRYPT);
                ?>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
    <BR/>
<?php 
include("_footer.php");
?>
</body>
</html>