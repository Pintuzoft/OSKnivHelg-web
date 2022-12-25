<?php

/*
    Class User
    This class is used to create a user object.
*/
class User {
    private $steamid;
    private $name;

    public function __construct($steamid, $name) {
        $this->steamid = $steamid;
        $this->name = $name;
    }

    public function getSteamid() {
        return $this->steamid;
    }

    public function getName() {
        return $this->name;
    }

    public function matchSteamID ( $in_steamID ) {
        if ( strcmp ( $this->steamid, $in_steamID ) == 0 ) {
            return true;
        } else {
            return false;
        }
    }
}
?>