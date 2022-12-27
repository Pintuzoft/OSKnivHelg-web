<?php

/* 
    Class Event

    This class is used to store the information of an event.
*/

class Event {
    private $stamp;
    private $attacker;
    private $attackerid;
    private $victim;
    private $victimid;
    private $points;

    public function __construct($stamp, $attacker, $attackerid, $victim, $victimid, $points) {
        $this->stamp = $stamp;
        $this->attacker = $attacker;
        $this->attackerid = $attackerid;
        $this->victim = $victim;
        $this->victimid = $victimid;
        $this->points = $points;
    }

    public function getStamp() {
        return $this->stamp;
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