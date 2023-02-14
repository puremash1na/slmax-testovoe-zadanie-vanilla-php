<?php

class Connect {
    public function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "30072003XXX";
        $dbname = "testtask";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}