<?php 
    include("_variables.php");

    function getBDD(){
        try{
            $getBDD= new PDO("mysql:host=".HOST.";dbname=".BDD.";charset=utf8mb4", USER, PASSW, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } 
        catch(PDOException $e){
            die('Erreur à la connexion : ' . $e->getMessage());
        }
        return $getBDD;
    }

    /**
    * name Connexion à la BDD en PDO
    * @param aucun paramètre à passer, elle sert uniquement à éviter de tout retaper
    * @return une connexion
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


    function look($latable, $lechamp, $lewhere, $lacle){
        // echo look("pizzas","titre","ingredients","tomate"); >> Corse
        
        $getBDD = getBDD(); 
        $getBDD->quote("$latable", PDO::PARAM_STR); // Protection des variables 
        $getBDD->quote("$lechamp", PDO::PARAM_STR);
        $getBDD->quote("$lewhere", PDO::PARAM_STR);
        $getBDD->quote("$lacle", PDO::PARAM_STR);

        $requete = $getBDD->prepare('SELECT '.$lechamp.' FROM '.$latable.' WHERE '.$lewhere.' = :lacle LIMIT 1');
        $requete->execute(array(':lacle' => $lacle));
    
        $resultat = $requete->fetch();
        $requete -> closeCursor();
        //echo "Fonction look :".$resultat["$lechamp"]." <BR>";

        return $resultat["$lechamp"];

    }

?>