<?php 
session_start();
require_once("fonctions/connexion.php");
?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Interaction Ajax et jQuery";
include("_head.php");
?>
<body onload="reload_les_donnees(); voir_caddie();">
<?php 
include("_navbar.php");
?>		
    <div class="container mt-4">
        <h1 class="text-center"><?= $titrepage ?><BR/><strong class="text-secondary">Mise à jour et interrogation</strong></h1>
        <div class="row">
            <div class="col p-2 border bg-light">
                <h3>Modification d'un champs de la BDD en ajax</h3>
                <input type="text" name="identif" id="identif" class="form-control" placeholder="Ajouter du texte" 
                onblur="var valeur = $(this).val(); $.ajax({url : 'ajax_maj.php', data: 'ligne=1&nouvellevaleur='+ valeur , type : 'POST', dataType : 'json'}); reload_les_donnees();">
            </div>

            <!-- Version simplifiée Pour vous aider à comprendre
            onblur="ajax_maj();" (suite à l'évènement ONBLUR (Relachement du focus de l'input))

            -> Voici les éléments décomposés si on écrivait version <script>
            <script>
            function ajax_maj() {
                var identif = getElementById('identif').val();
                $.ajax({
                    url:'ajax_maj.php',
                    data: 'ligne=1&nouvellevaleur=' + identif ,
                    type: 'POST',
                    datatype: 'json'
                });
            }
            </script>-->
            <!-- Pensez à inclure au minimum : 
            - Jquery
            - vous aurez besoin d'une table BDD dans laquelle on enregistrera les informations
            -->

            <div class="col p-2 border bg-light">
                <h3>Récupération données toutes les X secondes </h3>
                <script>
                //addEventListener('load', reload_les_donnees); // Sert à charger reload_les_donnees() dès le chargement de la page (sans ceci, on devrait attendre que setInterval soit executé)
                var timeout = setInterval(reload_les_donnees, 150000);   // Recherche toutes les x millisecondes la fonction
				
                function reload_les_donnees () { // La fonction qui charge les données

                    $('#ajax_recup').load('ajax_recup.php?ligne=1'); // On va afficher dans #ajax_recup ce qui va être demandé dans le fichier ajax_recup.php
				}
				</script>

				<div id="ajax_recup"></div>	
            </div>
        </div>
        
        <div class="row mt-5">

            <div class="col-md-5 p-2 border bg-light">
                <h3>Autocompletion BDD en Jquery/ajax</h3>
                <input type="text" name="motcle" id="titrepizzas" class="form-control" onkeyup="recup_lignes_bdd(this.value);" autocomplete="off">
            </div>

            <div class="col-md-7 p-2 border bg-light">
                <h3>Les champs se remplissent au clic de la sélection</h3>
                <input type="text" name="recup_des_infos" id="rempli_ingredients" class="form-control" autocomplete="off">
            </div>

        </div>
        <div id="suggest" style="display:none;">
            <ul id="auto_suggest"><!--LES LIGNES encoyées par ajax_recup_lignes_bdd.php--></ul>
        </div>

        <script type="text/javascript">
        function recup_lignes_bdd(motcle) {

            if(motcle.length <= 1) { // Si le nombre de caractères tapés est plus petit ou égal à 1, je cache #suggest
                $('#suggest').hide();
            } 
            else {
                $.post('ajax_recup_lignes_bdd.php', { motcle: ''+ motcle +''}, function(data){ 
                // On post les caractères "+ motcle +" et on récupère les lignes de résultats avec "data"

                    if(data.length >0) { // S'il y a plus de 0 résultat :
                        $('#suggest').show(); // J'affiche suggest
                        $('#auto_suggest').html(data); // J'affiche toutes les lignes envoyées par ajax_recup_lignes_bdd.php dans auto_suggest
                    } else {
                        $('#suggest').hide(); // Sinon je cache suggest
                    }
                });
            }
        }
        // Ces deux fonctions sont appelées dans les lignes de "auto_suggest"
        // Elles vont remplir les deux champs à partir de leur ID et fermer "suggest" lorsqu'on aura cliqué
        function recup_titre(thisValue){
            $('#titrepizzas').val(thisValue);
            $('#suggest').hide();
        }

        function affiche_ingredients(thisValue) {
            $('#rempli_ingredients').val(thisValue);
            $('#suggest').hide();
        };

        </script>
        <div class="row mt-5">

            <div class="col-md-7 p-2 border bg-white">
                <h3>Ajout caddie</h3>
                <table class="table table-hover">
                <?php 

                $getBDD = connexion(); 
                $req = $getBDD -> prepare('SELECT id, titre, pv_ttc FROM pizzas WHERE pv_ttc>10');
                $req -> execute();

                while($re= $req->fetch()){
                    $product_id=$re['id'];
                    $titre=$re['titre'];
                    $prix=$re['pv_ttc'];
                    ?>
                    <tr>
                        <th><?= $re['titre'] ?></th>
                        <td><?= $re['pv_ttc'] ?></td>
                        <td><input type="number" id="qte_<?= $product_id ?>" value="1" min="1" max="10" /></td>
                        <td><button class="btn btn-success" onclick="var qte = $('#qte_<?= $product_id ?>').val();  $.ajax({url:'ajax_add.php', type:'POST', data:'product_id=<?= $product_id ?>&qte=' + qte , datatype:'json'}); voir_caddie();">Ajouter</button></td>
                    </tr>
                
                    <?php
                }
                ?>
                </table>
            </div>

            <div class="col-md-5 p-4">
                <h3>NEW caddie</h3>


                <script>
                    function voir_caddie(){
                        $('#div_voir_caddie').load('voir_caddie.php');
                    }
                </script>
                <h5 id="div_voir_caddie"><!-- ici mon caddie--></h5>


                <button onclick="$.ajax({url:'ajax_add.php', data:'vider=oui', type:'POST', datatype:'JSON'}); voir_caddie();" class="btn btn-danger float-right">Vider le caddie</button>
                










                <!--
                <a class="btn btn-sm btn-danger float-right" onclick="$.ajax({url : 'ajax_caddie.php', data: 'action=vider', type : 'POST', dataType : 'json'}); recup_caddie(); ">Vider le caddie</a>
                -->
                <script>			
                /*
                var timeout = setInterval(recup_caddie, 1000000);
                function recup_caddie () { 

                    $('#recup_caddie').load('recup_caddie.php');
				}
				*/
                </script>

				<div id="recup_caddie"></div>	
                
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

<?php 
include("_footer.php");
?>
</body>
</html>