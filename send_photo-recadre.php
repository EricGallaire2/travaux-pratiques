<?php
    require("fonctions/connexion.php"); // Connexion à la BDD en PDO avec Try/Catch
    require('fonctions/urlise.php'); // Fonction pour remplacer les espaces et caractères spéciaux pour rendre une URL propre
    require('fonctions/autoincrement.php'); // Fonction pour remplacer les espaces et caractères spéciaux pour rendre une URL propre
    require('fonctions/fonctions_images.php'); // Fonctions de traitement des images
    include('fonctions/max_upload.php'); // Fonctions de calcul de la capacité du serveur en octets et Mo

    // Préambule
    $repertoire = "photos/"; // Dossier où seront les fichiers
    

    // Appel à la fonction dans le fichier max_upload.php 
    $uploadoctets=octets_max(); // Reconverti en octets ( à peu près)
    
    $thumb_prefix 	    = "thumb_"; 
    $thumb_size 	    = 370; 
    $max_image_size 	= 1000; 
    $jpeg_quality		= 90;


    // Un fichier a été envoyé ?
    // <input type="file" name="lefichier" class="form-control" accept=".jpg, image/jpg">

    if($_FILES['lefichier']!="") {


        $est_telechargeable=1; // initialiser comme étant téléchargeable
        $erreur="";
        $succes="";

        // Définition des variables
        $fichier_type=$_FILES['lefichier']['type'];
        $fichier_name=$_FILES['lefichier']['name']; 
        $fichier_size=$_FILES['lefichier']['size']; 
        $fichier_tmp_name=$_FILES['lefichier']['tmp_name'];
        
		$image_size_info = getimagesize($fichier_tmp_name); 
        
        /*
        // Affichage de toutes les informations EXIF (mais non-utilisées dans cette page)
        $lst_exif="";
        $exif = exif_read_data($fichier_tmp_name, 0, true);
        foreach ($exif as $key => $section) {
            foreach ($section as $name => $val) {
                
                $lst_exif.="$key.$name: $val<br />\n";
                
                if($name=="Orientation"){
                    $orientation="$val";
                }
            }
        }
        echo "$lst_exif";
        */
		
		if($image_size_info){
			$image_width 		= $image_size_info[0]; 
			$image_height 		= $image_size_info[1]; 
			//$image_type 		= $image_size_info['mime']; 
		} 
		else {
            $erreur.="Le fichier n'est pas valide";
            $est_telechargeable=0;
        }

        // Définition de l'extension et création d'une image tampon "temporaire"
		switch($fichier_type){
			case 'image/png':
				$image_res =  imagecreatefrompng($fichier_tmp_name); 
			    $extension = "png"; 
                break;

			case 'image/gif':
				$image_res =  imagecreatefromgif($fichier_tmp_name); 
			    $extension = "gif"; 
                break;	

			case 'image/jpeg':
            case 'image/jpg':
            case 'image/pjpeg':
				$image_res = imagecreatefromjpeg($fichier_tmp_name); 
			    $extension = "jpg"; 
                break;

			default:
                // On empeche le téléchargement
				$image_res = false;
                $est_telechargeable=0;
                $erreur.=" Fichier non accepté ";
		}

        // Un nom de fichier a-t-il été défini ?
        if($_POST['nomdufichier']!="") {
            //<input type="text" name="nomdufichier" class="form-control" placeholder="Forcer le Nom du fichier">
            $nomdefichier=$_POST['nomdufichier']; // Récupération du nom du fichier tel qu'il a été indiqué
            $nomdefichier="".$nomdefichier.".".$extension.""; // ajoute l'extension en fonction du type de fichier envoyé
        }
        else {
            $nomdefichier=$_FILES['lefichier']['name']; // C'est le nom original du fichier en cours de téléchargement
        }

        // On prépare le vrai nom du fichier et ses chemins d'accès
        $nomdefichier=urlise($nomdefichier); // transforme : j'espère.pdf en j-espere.pdf 
        $urldufichier=''.$repertoire.''.$nomdefichier.''; // uploads/nomdufichier.pdf
        $urldufichierthumb=''.$repertoire.''.$thumb_prefix.''.$nomdefichier.''; // Même chemin mais pour la version thumbnail

        // Est-ce que le fichier est pas plus lourd que ce que supporte le serveur ?
        if($fichier_size > $uploadoctets)  {
            $est_telechargeable=0;
            $erreur.=" Fichier trop lourd ";
        }
        
        // Est-ce qu'un fichier portant le même nom existe déjà ? Pour éviter de l'écraser
        // Cette vérification n'est pas obligatoire si écraser le fichier n'est pas grave
        if(file_exists($urldufichier)) {
            $est_telechargeable=0;
            $erreur.=" Fichier déjà existant ";
        }

        // Toutes les conditions sont OK, alors on commence à préparer le fichier
        if($est_telechargeable=="1") {

            // Création du thumbnail en premier
			if(image_carrer($image_res, $urldufichierthumb, $fichier_type, $thumb_size, $image_width, $image_height, $jpeg_quality)) {
                
                //Tout a fonctionné
                $succes="Téléchargement effectué";

                // J'enregistre en BDD
                $connexion=connexion();
                $sql="INSERT INTO photos (nom_du_fichier) VALUES ('$nomdefichier')";
                $requete=$connexion->prepare($sql);
                $requete->execute();
                
                // Je créé aussi l'original avec des dimensions et un poid inférieur
                image_resizer($image_res, $urldufichier, $fichier_type, $max_image_size, $image_width, $image_height, $jpeg_quality);

			}
            else {
                // Il y a eu un soucis de connexion, rien n'a fonctionné
                $erreur= "Erreur lors du téléchargement, veuillez recommencer...";
            }
			imagedestroy($image_res); // vidage de la mémoire 
        }
        else {
            $erreur.= " - Fichier non téléchargé";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Ré-échantillonnage d'une photo";
include("_head.php");
?>
<body>
    <?php 
    include("_navbar.php");
    ?>		
    <div class="container-fluid mt-2 mb-2 p-5" style="min-height:800px;">
        <h1 class="text-center"><?= $titrepage ?></h1>
        <div class="row">
            <div class="col border bg-light p-5">
                <!-- Formulaire d'envoi du fichier -->
                <form action="send_photo-recadre.php" method="POST" enctype="multipart/form-data">
                    <label class="mt-3">1- Choisir un nom de fichier</label>
                    <input type="text" name="nomdufichier" class="form-control" placeholder="Forcer le Nom du fichier">
                    
                    <label class="mt-3">2 - Selectionner un fichier à uploader (<?= affiche_upload_max() ?>) :</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?= octets_max() ?>" />
                    <input type="file" name="lefichier" class="form-control">
                    
                    <label class="mt-3">3 - Uploader le fichier</label>
                    <button type="submit" class="mt-1 btn btn-primary btn-block">Envoyer</button>
                </form>

            </div>
            <div class="col border bg-light p-5 border">

                <?= $erreur!="" ? '<div class="alert alert-warning">'.$erreur.'</div>' : '' ?>
                <?= $succes!="" ? '<div class="alert alert-success">'.$succes.'</div>' : '' ?>
                
                <?php
                // Effacer le fichier et effacer la ligne en BDD
                // send_pdf.php?id_a_effacer=$id&fichier_a_supprimer=$fichier
                if($_GET['id_a_effacer']!="" && $_GET['fichier_a_supprimer']!=""){

                    $url_a_supprimer=$repertoire.'/'.$_GET['fichier_a_supprimer'];
                    unlink($url_a_supprimer); // Suppression du fichier 

                    $thumbnail_a_supprimer=$repertoire.'/'.$thumb_prefix.''.$_GET['fichier_a_supprimer'];
                    unlink($thumbnail_a_supprimer); // Suppression du thumbnail

                    // Effacement de la ligne en BDD
                    $connexion=connexion();
                    $sql = "DELETE FROM photos WHERE id=:id_a_effacer";
                    $req = $connexion-> prepare ($sql);
                    $req -> execute(array(':id_a_effacer' => $_GET['id_a_effacer']));
                }
                
                // Liste toutes les lignes en base de données
                $connexion = connexion(); 
                $sql="SELECT * FROM photos";
                $req = $connexion -> prepare($sql);
                $req -> execute();
                ?>
                <div class="card-columns">
                <?php 
                while ($resultat= $req->fetch() ) {
                    
                    $fichier=$resultat['nom_du_fichier'];
                    $id=$resultat['id'];

                    if($fichier!="" && file_exists($repertoire.'/'.$fichier)) { 
                    // Vérifie que la ligne existe et que le fichier existe "réeelement"

                        switch ($icone) {
                            case 'pdf':
                                $img="<img src=\"$repertoire/icone-pdf.svg\" class=\"card-img-top\" />";
                                break;
                            case 'zip':
                            case 'rar':
                                $img="<img src=\"$repertoire/icone-zip.jpg\" class=\"card-img-top\" />";
                                break;
                            default:
                                $img="<img src=\"$repertoire$thumb_prefix$fichier\" class=\"card-img-top\" />";
                        }
                        ?>
                        <div class="card m-2">
                            <div class="card-body text-center">
                                <a href="<?= $repertoire ?>/<?= $fichier ?>" target="_blank"><?= $fichier ?></a>
                            </div>
                            <div class="">
                                <?= $img ?>
                            </div>
                            <div class="">
                                <a href="send_photo-recadre.php?id_a_effacer=<?= $id ?>&fichier_a_supprimer=<?= $fichier ?>" class="btn btn-danger btn-block">Supprimer</a>
                            </div>
                        </div>
                        <?php 
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>
<?php
include("_footer.php");
?>
</body>
</html>