<?php
    // utilisation :     $next_id=autoincrement("table");

    
    /**
     * autoincrement
     *
     * @param : nom de la table $latable
     * @param : la table doit avoir un autoincrément
     * @return : Prochain autoincrement d'une table si besoin de l'avoir avant l'insertion
     */
    function autoincrement($latable) {
        // Attention pour fonctionner, il faut soit utiliser la fonction "connexion()", donc faire un require_once de cette fonction 
        $getBDD = connexion(); 
        $req = $getBDD -> prepare("SHOW TABLE STATUS WHERE name='$latable'");
        $req -> execute();

        $res= $req->fetch();
        $res = $res['Auto_increment'];
        return $res;
    }


?>