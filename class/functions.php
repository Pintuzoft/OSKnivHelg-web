<?php
include_once 'mysql.php';

function getEventList ( ) {
    global $mysql;
    $eList = new ArrayList();
    $query = "SELECT * FROM event ORDER BY time DESC";
    $stmt = $mysql->prepare($query);
    $stmt->execute();
    $stmt->bind_result($time, $attacker, $attackerid, $victim, $victimid, $points);
    while ( $stmt->fetch()) {
        $eList->add(new Event($time,$attacker,$attackerid,$victim,$victimid,points));
    }
    return $eList;
}

?>