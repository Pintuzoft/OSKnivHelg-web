<?php
include_once 'mysql.php';
include_once 'arraylist.php';

function getEventList ( ) {
    global $mysql;
    $eList = new ArrayList ( );
    $query = "SELECT stamp,attacker,attackerid,victim,victimid,points FROM event ORDER BY stamp DESC";
    $stmt = $mysql->prepare ( $query ) or die ( "Error: " . $mysql->getError ( ) );
    $stmt->execute ( ) or die ( "Error: " . $mysql->getError ( ) );
    $stmt->store_result ( );
    $stmt->bind_result ( $stamp, $attacker, $attackerid, $victim, $victimid, $points ) or die ( "Error: " . $mysql->getError ( ) );
    while ( $stmt->fetch ( ) ) {
        $eList->add ( new Event ( $stamp, $attacker, $attackerid, $victim, $victimid, $points ) );
    }
    return $eList;
}

?>