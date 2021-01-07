<!DOCTYPE html>
<html lang="fr">
<?php 
    $titrepage="page 404";
    include("_head.php");

    $delai=5; 
?>
<body>
<?php 
include("_navbar.php");
?>
    <div class="container text-center">
        <h1 class="text-center">Erreur 404 personnalisée</h1>

        <h3 id="Crono"></h3>
        <meta http-equiv="refresh" content="<?= $delai ?>;URL=index.php">
    </div>
    <script>
    var cpt = <?= $delai ?>;
    timer = setInterval(function(){
        if(cpt>0) {
            --cpt;
            document.getElementById("Crono").innerHTML = "Redirection dans " + cpt + " secondes" ;
        }
        else{
            clearInterval(timer);
        }
    }, 1000);
    </script>
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