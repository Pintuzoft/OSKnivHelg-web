<?php

$mysql = new MySQL($mysql_host, $mysql_user, $mysql_password, $mysql_database);

class MySQL {
    private $connection;

    public function __construct($host, $user, $password, $database) {
        $this->connection = new mysqli($host, $user, $password, $database);

        if ($this->connection->connect_error) {
            die("MySQL connection failed: " . $this->connection->connect_error);
        }

        if (!$this->connection->set_charset('utf8mb4')) {
            die("MySQL charset error: " . $this->connection->error);
        }

        return $this;
    }

    public function query($query) {
        return $this->connection->query($query);
    }

    public function escape($string) {
        return $this->connection->real_escape_string($string);
    }

    public function getError() {
        return $this->connection->error;
    }

    public function prepare($query) {
        return $this->connection->prepare($query);
    }

    public function __destruct() {
        if ($this->connection instanceof mysqli) {
            $this->connection->close();
        }
    }
}

?>
