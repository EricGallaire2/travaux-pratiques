<?php 
function urlise($mot_avec_accent)
{
    // Remplace un mot avec accent en un mot sans accent en MINUSCULE
    // Sont traités : é, è, ê, ë, à, â, î, ç, ô, ö, ù, û
    //https://www.eric-web.com/travaux-pratriques/uploads/j'espère.jpg
    //https://www.eric-web.com/travaux-pratriques/uploads/j-espere.jpg

    $res = strtolower($mot_avec_accent) ;
    
    

    $res = str_replace("\""," ", $res) ;
    $res = str_replace("&","et", $res) ;
    $res = str_replace("ä","a", $res) ;
    $res = str_replace("â","a", $res) ;
    $res = str_replace("à","a", $res) ;
    $res = str_replace("ç","c", $res) ;
    $res = str_replace("î","i", $res) ;
    $res = str_replace("ï","i", $res) ;
    $res = str_replace("ù","u", $res) ;
    $res = str_replace("û","u", $res) ;
    $res = str_replace("ü","u", $res) ;
    $res = str_replace("ô","o", $res) ;
    $res = str_replace("ö","o", $res) ;
    $res = str_replace("é","e", $res) ;
    $res = str_replace("è","e", $res) ;
    $res = str_replace("ê","e", $res) ;
    $res = str_replace("ë","e", $res) ;
    $res = str_replace("Œ","OE", $res) ;
    $res = str_replace("œ","oe", $res) ;
    $res = str_replace("Ë","e", $res) ;
    $res = str_replace("Ê","e", $res) ;
    $res = str_replace("È","e", $res) ;
    $res = str_replace("É","e", $res) ;
    $res = str_replace("Ì","i", $res) ;
    $res = str_replace("Í","i", $res) ;
    $res = str_replace("Î","i", $res) ;
    $res = str_replace("Ï","i", $res) ;
    $res = str_replace("À","a", $res) ;
    $res = str_replace("Â","a", $res) ;
    $res = str_replace("Ä","a", $res) ;
    $res = str_replace("Ç","c", $res) ;
    $res = str_replace("Ô","o", $res) ;
    $res = str_replace("Ù","u", $res) ;
    $res = str_replace("Û","u", $res) ;
    $res = str_replace("Ü","u", $res) ;
    $res = str_replace("'"," ", $res) ;
	$res = str_replace(",","", $res) ;
    $res = str_replace(";","", $res) ;
    $res = str_replace(":","", $res) ;
    $res = str_replace("!","", $res) ;
    $res = str_replace(" ","-", $res) ;
    $res = str_replace("--","-", $res) ; 
	
    return($res) ;
}
?>