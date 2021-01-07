<?php
function temps_passe($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'annee',
        'm' => 'mois',
        'w' => 'semaine',
        'd' => 'jour',
        'h' => 'heure',
        'i' => 'minute',
        's' => 'seconde',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) { 
            if($v!='m') {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 && $k!='m' ? 's' : '');
            }         
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return  $string ? 'Il y a '.implode(', ', $string) . '' : ' à l\'instant';
}


echo '<BR>'.temps_passe('2019-05-01 00:22:35');

echo '<BR>'.temps_passe('2020-12-18 17:59:35', true); // version complète

echo '<HR>'.date("Y-m-d", 1597367755).' <BR>'.temps_passe('@1597367755'); # timestamp

?>