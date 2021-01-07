<?php

// Vérification que le parametre "langue" est bien passé en GET sinon en "fr" par défaut
$langue = (isset($_GET['langue']) && file_exists(''.$_GET['langue'].'.json')) ? $_GET['langue'] : 'fr';

// Définition de la classe CSS pour activer ou non le bouton de langue
if ($langue == 'fr') {
    $fr_class = ' active';
    $en_class = ' ';
}
else {
    $fr_class = ' ';
    $en_class = ' active';
}

// Récupération du contenu du fichier .json 
$contenu_fichier_json = file_get_contents(''.$langue.'.json');

// Récupératyion des données en tableau 
$chaine = json_decode($contenu_fichier_json, true);

?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage= $chaine['head_title'];
include("_head.php");
?>
<body>
<?php 
include("_navbar.php");
?>
    
    <body>
        <div class="container mt-5" style="min-height:1000px;">
            
            <div class="row">
                <div class="col-6">
                    <div class="btn group d-flex">
                        <a class="btn btn-info <?php echo $fr_class ?>" href="?langue=fr">Français</a> 
                        <a class="btn btn-info <?php echo $en_class ?>" href="?langue=en">Anglais</a> 
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="border p-3">
                        <h1><?php echo $chaine['head_title'] ?></h1>
                        <p><?php echo $chaine['site_description'] ?></p>
                        <?php echo $chaine['page_content'] ?>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="bg-white p-2 text-secondary" id="jsonfr" style="display:none;">
                        <pre><?php include('fr.json'); ?></pre>
                    </div>
                    <div class="bg-white p-2 text-secondary" id="jsonen" style="display:none;">
                        <pre><?= $contenu_fichier_json ?></pre>
                    </div>
                    <HR>
                    <div class="bg-white p-2 text-secondary" id="source" style="display:none;">
                        <pre class="p-2">
// Vérification que le parametre "langue" est bien passé en GET sinon en "fr" par défaut
$langue = (isset($_GET['langue']) && file_exists(''.$_GET['langue'].'.json')) ? $_GET['langue'] : 'fr';

// Définition de la classe CSS pour activer ou non le bouton de langue
if ($langue == 'fr') {
    $fr_class = ' active';
    $en_class = ' ';
}
else {
    $fr_class = ' ';
    $en_class = ' active';
}

// Récupération du contenu du fichier .json concerné par la langue
$contenu_fichier_json = file_get_contents(''.$langue.'.json');

// Récupératyion des données en tableau 
$chaine = json_decode($contenu_fichier_json, true);
                        </pre>
                    </div>
                </div>
            </div>
        </div>
<?php 
include("_footer.php");
?>

    </body>
</html>
