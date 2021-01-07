<?php
    require_once("fonctions/connexion.php");
?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Le Rewrite avec htaccess";
include("_head.php");
?>
<body>
<?php 
include("_navbar.php");

?>

    <div class="container pt-5 mt-5">
        <h1><?=$titrepage?></h1>
        <div class="row">
            <div class="col m-2 p-2 bg-light text-secondary">
                <h2>Rewrite simple</h2>
                <a href="mapage.html" class="btn btn-success">mapage.html - autre-page.php</a>
            </div>
            <div class="col m-2 p-2 bg-light text-secondary">
                <h2>Rewrite variables</h2>
                <div class="btn-group d-flex">
                    <a href="page-1/jolie-page.php" class="btn btn-info">Var=1</a>
                    <a href="page-2/autre-jolie-page.php" class="btn btn-info">Var=2</a>
                    <a href="page-3/et-celle-la-aussi.php" class="btn btn-info">Var=3</a>
                </div>
            </div>
            <div class="col m-2 p-2 bg-light text-secondary">
                <h2>Rewrite variables ID</h2>
                <div class="btn-group d-flex">
                    <?php $rand=rand(10,99); ?>
                    <a href="chemin/<?= $rand?>.html" class="btn btn-info">Var=<?= $rand?></a>
                </div>
            </div>
        </div>
    </div>
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