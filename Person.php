<?php
require_once 'connect.php';

class Person {
    private $id, $name, $surname, $birthdate, $gender, $birthplace;

    public function __construct($id = null, $conn) {
        $this->conn = $conn;
        if ($id) {
            $sql = "SELECT * FROM users WHERE id = '$id'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $person = $result->fetch_assoc();
                $this->id = $person['id'];
                $this->name = $person['name'];
                $this->surname = $person['surname'];
                $this->birthdate = $person['datebirth'];
                $this->gender = $person['sex'];
                $this->birthplace = $person['birthplace'];
            }
        }
    }

    public function savePerson() {
        $sql = "INSERT INTO 
                users (name, surname, datebirth, sex, birthplace)
                VALUES ('$this->name', '$this->surname', '$this->birthdate', '$this->gender', '$this->birthplace')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function destroyPerson() {
        $sql = "DELETE FROM 
                users 
                WHERE id='$this->id'";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public static function getDateToYears($birthdate) {
        $today = new DateTime();
        $diff = $today->diff(new DateTime($birthdate));
        return $diff->y;
    }
    public static function getBooleanGender($gender) {
        return $gender == 0 ? 'Male' : 'Female';
    }
    public function convert($datebirth = false, $sex = false) {
        $person = new stdClass();
        $person->id = $this->id;
        $person->name = $this->name;
        $person->surname = $this->surname;
        $person->birthplace = $this->birthplace;
        if ($datebirth)
            $person->age = self::getDateToYears($this->birthdate);
        if ($sex)
            $person->gender = self::getBooleanGender($this->gender);
        return $person;
    }
}