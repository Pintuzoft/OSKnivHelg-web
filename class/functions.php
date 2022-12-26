<?php
include_once 'mysql.php';

function getEventList ( ) {
    global $mysql;
    $eList = new ArrayList();
    $query = "SELECT * FROM event ORDER BY time DESC";
    $stmt = $mysql->prepare($query);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $eList->add(new Event($row['time'], $row['attacker'], $row['victim'], $row['points']));
    }
    return $eList;
}

?>