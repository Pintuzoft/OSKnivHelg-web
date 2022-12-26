<?php

/* 
    Class Event

    This class is used to store the information of an event.
*/

class Event {
    private $time;
    private $attacker;
    private $victim;
    private $points;

    public function __construct($time, $attacker, $victim, $points) {
        $this->time = $time;
        $this->attacker = $attacker;
        $this->victim = $victim;
        $this->points = $points;
    }

    public function getTime() {
        return $this->time;
    }

    public function getAttacker() {
        return $this->attacker;
    }

    public function getVictim() {
        return $this->victim;
    }

    public function getPoints() {
        return $this->points;
    }

}
?>