<?php 
    require("_variables.php"); // Récupération des variables de connexion BDD    
    /**
     * connexion PDO
     *
     * @return $connexion établie
     */
    function connexion(){
        try {
            $connexion= new PDO ("mysql:host=".HOST.";dbname=".BDD.";charset=utf8", USER, PASSW, array(PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION));
        }
        catch (PDOException $exception) {
            die('Erreur fonction connexion : ' . $exception->getMessage());
        }
        return $connexion;
    }



?>