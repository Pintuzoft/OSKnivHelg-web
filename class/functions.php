<?php
include_once 'mysql.php';

function getEventList ( ) {
    global $mysql;
    $eList = new ArrayList ( );
    $query = "SELECT * FROM event ORDER BY time DESC";
    $stmt = $mysql->prepare ( $query );
    $stmt->execute ( );
    $stmt->store_result ( );
    $stmt->bind_result ( $time, $attacker, $attackerid, $victim, $victimid, $points );
    while ( $stmt->fetch ( ) ) { 
        echo "Event:";
        echo " - Time: " . $time;
        echo " - Attacker: " . $attacker;
        echo " - AttackerID: " . $attackerid;
        echo " - Victim: " . $victim;
        echo " - VictimID: " . $victimid;
        echo " - Points: " . $points;

        $eList->add ( new Event ( $time, $attacker, $attackerid, $victim, $victimid, $points ) );
    }
    return $eList;
}

?>