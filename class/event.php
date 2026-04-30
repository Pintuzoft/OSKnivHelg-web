<?php

/*
    Class Event
    Stores one knife event. Player IDs are SteamID64 values.
*/
class Event {
    private $stamp;
    private $attacker;
    private $attackerSteamId64;
    private $victim;
    private $victimSteamId64;
    private $points;
    private $type;

    public function __construct($stamp, $attacker, $attackerSteamId64, $victim, $victimSteamId64, $points, $type) {
        $this->stamp = $stamp;
        $this->attacker = $attacker;
        $this->attackerSteamId64 = $attackerSteamId64;
        $this->victim = $victim;
        $this->victimSteamId64 = $victimSteamId64;
        $this->points = $points;
        $this->type = $type;
    }

    public function getStamp() {
        return $this->stamp;
    }

    public function getAttacker() {
        return $this->attacker;
    }

    public function getAttackerID() {
        return $this->attackerSteamId64;
    }

    public function getAttackerSteamId64() {
        return $this->attackerSteamId64;
    }

    public function getVictim() {
        return $this->victim;
    }

    public function getVictimID() {
        return $this->victimSteamId64;
    }

    public function getVictimSteamId64() {
        return $this->victimSteamId64;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getType() {
        return $this->type;
    }
}
?>
