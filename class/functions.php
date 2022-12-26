<?php
include_once 'mysql.php';

function getEventList ( ) {
    global $mysql;
    $eList = new ArrayList();
    $query = "SELECT * FROM event ORDER BY time DESC";
    $mysql->prepare($query);
    $mysql->execute();
    while ($row = $mysql->fetch()) {
        $eList->add(new Event($row['time'], $row['attacker'], $row['victim'], $row['points']));
    }
    return $eList;
}

?>