<?php

/* 
    Class Event

    This class is used to store the information of an event.
*/

class Event {
    private $time;
    private $attacker;
    private $attackerid;
    private $victim;
    private $victimid;
    private $points;

    public function __construct($time, $attacker, $attackerid, $victim, $victimid, $points) {
        $this->time = $time;
        $this->attacker = $attacker;
        $this->attackerid = $attackerid;
        $this->victim = $victim;
        $this->victimid = $victimid;
        $this->points = $points;
    }

    public function getTime() {
        return $this->time;
    }

    public function getAttacker() {
        return $this->attacker;
    }

    public function getAttackerID() {
        return $this->attackerid;
    }

    public function getVictim() {
        return $this->victim;
    }

    public function getVictimID() {
        return $this->victimid;
    }
    
    public function getPoints() {
        return $this->points;
    }

}
?>