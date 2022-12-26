<?php
echo "$mysql_host";
echo "$mysql_database";
echo "$mysql_user";
echo "$mysql_password";

$mysql = new MySQL($mysql_host, $mysql_user, $mysql_password, $mysql_database);

class MySQL {
    private $connection;

    public function __construct($host, $user, $password, $database) {
        $this->connection = new mysqli($host, $user, $password, $database) or die("Error " . mysqli_error($this->mysqli));
        if ( $this->connection->connect_errno ) {
            die("Failed to connect to MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error);
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
        $this->connection->close();
    }

}

?>