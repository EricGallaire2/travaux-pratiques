<?php 
    function affiche_upload_max() {
        // Calcul de la capacité du serveur dans le fichier php.ini
        $max_upload = (int)(ini_get('upload_max_filesize')); // upload_max_filesize = 2M -> 2
        $max_post = (int)(ini_get('post_max_size')); // post_max_size = 8M -> 8
        $upload_mb = min($max_upload, $max_post); // Prend le plus petit des 2
        $upload_mb=$upload_mb/8; // Diviser par 8 bits en Mega Octets
        return "Maximum $upload_mb Mo";
    }

    function octets_max() {
        // Calcul de la capacité du serveur dans le fichier php.ini
        $max_upload = (int)(ini_get('upload_max_filesize')); // upload_max_filesize = 2M -> 2
        $max_post = (int)(ini_get('post_max_size')); // post_max_size = 8M -> 8
        $upload_mb = min($max_upload, $max_post); // Prend le plus petit des 2
        $upload_mb=$upload_mb/8; // Diviser par 8 bits en MEga Octets
        $uploadoctets=$upload_mb*1000000; // Reconverti en octets ( à peu près)
        return $uploadoctets;
    }

?>