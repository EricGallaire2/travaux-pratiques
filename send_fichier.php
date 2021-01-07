<?php
    require_once("fonctions/connexion.php");
    include('fonctions/urlise.php'); // Fonction pour remplacer les espaces et caractères spéciaux et renvoyer une URL propre
    include('fonctions/max_upload.php'); // Fonctions de calcul de la capacité du serveur en octets et Mo

    // Préambule
    $repertoire = "uploads"; // Dossier où seront les fichiers
    $uploadoctets=octets_max(); // Reconverti en octets ( à peu près)

  
    // Un fichier a été envoyé ?
    // <input type="file" name="lefichier" class="form-control" accept=".pdf, application/pdf">
    if($_FILES['lefichier']!="") {

        $est_telechargeable=1; // initialiser comme étant téléchargeable. Au fur et à mesure des vérifications si les conditions ne sont pas replies, on transformera $est_telechargeable à "0"

        // Initialisation des messages 
        $erreur="";
        $succes="";
        //var_dump($_FILES['lefichier']); // Pour tester le retour d'information
        //die(); // Pour stopper le code


        // de quel type le fichier est-il fait ?
        $typedefichier=$_FILES['lefichier']['type']; 
        /*
        POUR INFORMATION PAR EXEMPLE
        CSV     application/vnd.ms-excel / text/csv
        jpg     image/jpeg / image/jpg / image/jfiff
        png     image/png
        txt     text/plain
        zip     application/x-zip-compressed
        pdf     application/pdf
        docx    application/vnd.openxmlformats / application/vnd.openxmlformats-officedocument.wordprocessingml.document - 
        doc     application/msword  
        xls     application/vnd.ms-excel
        xlsx    application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
        rar     application/x-rar-compressed
        */
        
        if($typedefichier=="application/pdf") {
            $icone="pdf";
            $extension="pdf";
        }
        elseif ($typedefichier=="image/jpeg") {
            $icone="";
            $extension="jpg";
        }
        elseif ($typedefichier=="image/png") {
            $icone="";
            $extension="png";
        }
        elseif ($typedefichier=="application/x-zip-compressed") {
            $icone="zip";
            $extension="zip";
        }
        else {
            $est_telechargeable=0;
            $erreur.=" Ce fichier ne fait pas partie des fichiers acceptés ";
        }

        // Est-ce que le fichier est pas plus lourd que ce que supporte le serveur ?
        if($_FILES['lefichier']['size'] > $uploadoctets)  {
            $est_telechargeable=0;
            $erreur.=" Fichier trop lourd ";
        }

        // Est-ce qu'un fichier portant le même nom existe déjà ? Pour éviter de l'écraser
        // Cette vérification n'est pas obligatoire si écraser le fichier n'est pas grave
        if(file_exists($nomdefichier)) {
            $est_telechargeable=0;
            $erreur.=" Fichier déjà existant ";
        }

        
        // Toutes les conditions sont OK, alors on commence à préparer le fichier
        if($est_telechargeable=="1") {

            // Est-ce qu'un nom de fichier a été indiqué ?
            if($_POST['nomdufichier']!="") {
                //<input type="text" name="nomdufichier" class="form-control" placeholder="Forcer le Nom du fichier">
                $nomdefichier=$_POST['nomdufichier']; // On récupère le nom du fichier
                $nomdefichier="".$nomdefichier.".".$extension.""; // On ajoute l'extension en fonction du type de fichier envoyé
            }
            else {
                $nomdefichier=$_FILES['lefichier']['name']; // C'est le nom original du fichier en cours de téléchargement (l'extension est déjà présente)
            }

            // Traitement des caractères spéciaux
            $nomdefichier=urlise($nomdefichier); // transforme : j'espère.pdf en j-espere.pdf 

            // Quelle sera l'url complète du fichier téléchargé ?
            $urldufichier=''.$repertoire.'/'.$nomdefichier.''; // uploads/nomdufichier.pdf

            // On télécharge le fichier mais on prévoit aussi qu'il peut y avoir une déconnexion d'internet
            if(move_uploaded_file($_FILES['lefichier']['tmp_name'], $urldufichier)) { 
            // move_uploaded_file -> 2 paramètres : repertoire/Fichier temporaire + repertoire/Fichier cible
                
                // Message en cas de succes
                $succes="Téléchargement effectué";

                // J'enregistre le nom du fichier et son icone en base de données 
                $connexion=connexion();
                $sql="INSERT INTO fichiers (nomdufichier, icone) VALUES ('$nomdefichier','$icone')";
                $requete=$connexion->prepare($sql);
                $requete->execute();
            }
            else {
                // Message en cas d'erreur
                $erreur= "Erreur lors du téléchargement, veuillez recommencer...";
            }
        }
        else {
            // Message en cas de plusieurs erreurs
            $erreur.= " - Fichier non téléchargé";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Envoi d'un fichier";
include("_head.php");
?>
<body>
<?php 
include("_navbar.php");
?>		
    <div class="container-fluid mt-2 mb-2 p-5" style="min-height:800px;">
        <h1 class="text-center"><?= $titrepage ?></h1>
        <div class="row">
            <div class="col bg-light p-5">
                <form action="send_fichier.php" method="POST" enctype="multipart/form-data">
                    <label class="mt-4">1 - Donnez un nom à votre fichier</label>
                    <input type="text" name="nomdufichier" class="form-control" placeholder="Forcer le Nom du fichier">
                    
                    <label class="mt-4">2 - Selectionner un fichier à uploader (<?= affiche_upload_max() ?>)</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?= octets_max() ?>" />
                    <input type="file" name="lefichier" class="form-control">
                    <label class="mt-4">3 - Puis cliquez sur "Envoyer"</label>
                    <button type="submit" class="mt-1 btn btn-primary btn-block">Envoyer</button>
                </form>
            </div>
            <div class="col bg-light p-5 border">

                <?= $erreur!="" ? '<div class="alert alert-warning">'.$erreur.'</div>' : '' ?>
                <?= $succes!="" ? '<div class="alert alert-success">'.$succes.'</div>' : '' ?>
                
                <?php
                // Effacer le fichier et effacer la ligne en BDD
                // send_fichier.php?id_a_effacer=$id&fichier_a_supprimer=$fichier
                if($_GET['id_a_effacer']!="" && $_GET['fichier_a_supprimer']!=""){

                    // Construction du chemin d'accès au fichier
                    $url_a_supprimer=$repertoire.'/'.$_GET['fichier_a_supprimer'];
                    unlink($url_a_supprimer); // Suppression du fichier

                    // Suppression de la ligne concernée de la BDD
                    $connexion=connexion();
                    $sql = "DELETE FROM fichiers WHERE id=:id_a_effacer";
                    $req = $connexion-> prepare ($sql);
                    $req -> execute(array(':id_a_effacer' => $_GET['id_a_effacer']));
                }
                
                // Liste toutes les lignes en base de données
                $connexion = connexion(); 
                $sql="SELECT * FROM fichiers";
                $req = $connexion -> prepare($sql);
                $req -> execute();
                while ($resultat= $req->fetch() ) {
                
                    // Définition des variables
                    $fichier=$resultat['nomdufichier'];
                    $id=$resultat['id'];
                    $icone=$resultat['icone'];
                    
                    // Vérifie que la ligne existe et que le fichier existe "réeelement"
                    if($fichier!="" && file_exists($repertoire.'/'.$fichier)) { 
                        // SI le fichier est bel et bien existant, on affiche la liste

                        // Quel est le visuel à afficher selon le type de fichier
                        switch ($icone) {
                            case 'pdf':
                                $img="<img src=\"$repertoire/icone-pdf.svg\" class=\"img-fluid\" />";
                                break;
                            case 'zip':
                            case 'rar':
                                $img="<img src=\"$repertoire/icone-zip.jpg\" class=\"img-fluid\" />";
                                break;
                            default:
                                $img="<img src=\"$repertoire/$fichier\" class=\"img-fluid\" />"; // C'est une photo
                        }
                        ?>
                        <div class="list-group-item list-group-item-action">
                            <div class="row">
                                <div class="col-md-1">
                                    <?= $img ?>
                                </div>
                                <div class="col-md-9">
                                    <a href="<?= $repertoire ?>/<?= $fichier ?>" target="_blank"><?= $fichier ?></a>
                                </div>
                                <div class="col-md-2">
                                    <a href="send_fichier.php?id_a_effacer=<?= $id ?>&fichier_a_supprimer=<?= $fichier ?>" class="text-danger">Supprimer</a>
                                </div>
                            </div>
                        </div>
                        <?php 
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php 
include("_footer.php");
?>
</body>
</html>