<?php

class MySQL {
    private $mysqli;

    public function __construct($host, $user, $password, $database) {
        $this->mysqli = new mysqli($host, $user, $password, $database);
    }

    public function query($query) {
        return $this->mysqli->query($query);
    }

    public function escape($string) {
        return $this->mysqli->real_escape_string($string);
    }

    public function getError() {
        return $this->mysqli->error;
    }

    public function prepare($query) {
        return $this->mysqli->prepare($query);
    }
}

?>