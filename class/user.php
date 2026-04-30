<?php

/*
    Class User
    This class is used to create a leaderboard user object.
*/
class User {
    private $steamid64;
    private $name;
    private $points;

    public function __construct($steamid64, $name, $points) {
        $this->steamid64 = $steamid64;
        $this->name = $name;
        $this->points = $points;
    }

    public function getSteamId64() {
        return $this->steamid64;
    }

    public function getSteamid() {
        return $this->steamid64;
    }

    public function getName() {
        return $this->name;
    }

    public function getPoints() {
        return $this->points;
    }

    public function matchSteamID($in_steamID) {
        return strcmp((string)$this->steamid64, (string)$in_steamID) == 0;
    }
}
?>
