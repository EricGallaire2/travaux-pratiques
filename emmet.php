<?php

?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Emmet";
include("_head.php");
?>
<body>
<?php 
include("_navbar.php");
?>		
    <div class="container-fluid mt-2 mb-2 p-5">
        <h1 class="text-center">Utilisation d'EMMET</h1>
        <div class="row">
            <div class="col border bg-light">
                <pre class="text-secondary">
                <code>
        <code>
-> h1{bienvenue}>form:post>div.row>div.col-xs-12*2>label>input:text#champ$.form-control
        <ul>
            <li>{ sert à ajouter du texte dans la balise}</li>
            <li>:post Ajoute l'attribut post et cela fonctionne également avec d'autres attributs</li>
            <li>> Ajout dans le contenant</li>
            <li>.nom-de-la-classe Ajoute la classe à la balise</li>
            <li>*2 incrémente le nombre de fois la même balise</li>
            <li>$ incrémente de 1 un ID</li>
            <li>+ insére une nouvelle balise après la balise précédente</li>
        </ul>
-> h1{editer}div*2




-> div.row>div.col*4+footer>div.row>div.col*2
        </code>

        </pre>
            </div>
        </div>
    </div>
<?php 
include("_footer.php");
?>
</body>
</html>