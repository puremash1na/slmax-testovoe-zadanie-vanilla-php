<?php
require_once 'connect.php';
if (!class_exists("Person")) {
    echo "Error: Class 'Person' does not exist.";
} else {
    class PersonList {
        private $idList;
        public function __construct() {
            $db = new Connect();
            $conn = $db->connect();
            $query = "SELECT * FROM users";
            $result = $conn->query($query);
            while($row = $result->fetch_assoc()){
                $this->idList[] = $row['id'];
            }
            $conn->close();
        }
        public function getAllPersons() {
            $db = new Connect();
            $conn = $db->connect();
            $personInstances = [];
            foreach ($this->idList as $id) {
                $personInstances[] = new Person($id,$conn);
                //var_dump($personInstances);
            }
            return $personInstances;
        }
        public function destroyPerson() {
            $personInstances = $this->getAllPersons();
            $db = new Connect();
            $conn = $db->connect();
            foreach ($personInstances as $personInstance) {
                $query = "DELETE FROM users WHERE id = '" . $personInstance->getId() . "'";
                mysqli_query($conn, $query);
            }
            $conn->close();
        }
    }
}