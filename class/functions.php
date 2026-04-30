<?php
include_once 'mysql.php';
include_once 'arraylist.php';

function getEventList() {
    global $mysql;
    $eList = new ArrayList();
    $query = "SELECT stamp,attacker,attackerid64,victim,victimid64,points,type FROM `event` ORDER BY stamp DESC";
    $stmt = $mysql->prepare($query) or die("Error: " . $mysql->getError());
    $stmt->execute() or die("Error: " . $mysql->getError());
    $stmt->store_result();
    $stmt->bind_result($stamp, $attacker, $attackerid64, $victim, $victimid64, $points, $type) or die("Error: " . $mysql->getError());

    while ($stmt->fetch()) {
        $eList->add(new Event($stamp, $attacker, $attackerid64, $victim, $victimid64, $points, $type));
    }

    $stmt->close();
    return $eList;
}

function getUserListSorted() {
    global $mysql;
    $uList = new ArrayList();
    $query = "SELECT steamid64,name,points FROM userstats ORDER BY points DESC";
    $stmt = $mysql->prepare($query) or die("Error: " . $mysql->getError());
    $stmt->execute() or die("Error: " . $mysql->getError());
    $stmt->store_result();
    $stmt->bind_result($steamid64, $name, $points) or die("Error: " . $mysql->getError());

    while ($stmt->fetch()) {
        $uList->add(new User($steamid64, $name, $points));
    }

    $stmt->close();
    return $uList;
}

function getDashboardStats() {
    global $mysql;

    $stats = array(
        'total_events' => 0,
        'total_players' => 0,
        'total_points' => 0,
        'top_name' => null,
        'top_points' => null,
        'top_steamid64' => null,
        'latest_stamp' => null
    );

    $query = "SELECT COUNT(*), MAX(stamp) FROM `event`";
    $stmt = $mysql->prepare($query) or die("Error: " . $mysql->getError());
    $stmt->execute() or die("Error: " . $mysql->getError());
    $stmt->bind_result($totalEvents, $latestStamp) or die("Error: " . $mysql->getError());
    if ($stmt->fetch()) {
        $stats['total_events'] = (int)$totalEvents;
        $stats['latest_stamp'] = $latestStamp;
    }
    $stmt->close();

    $query = "SELECT COUNT(*), COALESCE(SUM(points), 0) FROM userstats";
    $stmt = $mysql->prepare($query) or die("Error: " . $mysql->getError());
    $stmt->execute() or die("Error: " . $mysql->getError());
    $stmt->bind_result($totalPlayers, $totalPoints) or die("Error: " . $mysql->getError());
    if ($stmt->fetch()) {
        $stats['total_players'] = (int)$totalPlayers;
        $stats['total_points'] = (int)$totalPoints;
    }
    $stmt->close();

    $query = "SELECT steamid64,name,points FROM userstats ORDER BY points DESC LIMIT 1";
    $stmt = $mysql->prepare($query) or die("Error: " . $mysql->getError());
    $stmt->execute() or die("Error: " . $mysql->getError());
    $stmt->bind_result($topSteamid64, $topName, $topPoints) or die("Error: " . $mysql->getError());
    if ($stmt->fetch()) {
        $stats['top_steamid64'] = $topSteamid64;
        $stats['top_name'] = $topName;
        $stats['top_points'] = (int)$topPoints;
    }
    $stmt->close();

    return $stats;
}

?>
