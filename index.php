<?php
require_once 'connect.php';
require_once 'Person.php';
require_once 'PersonList.php';

$db = new Connect();
$conn = $db->connect();

$person = new Person(2, $conn);
var_dump($person->convert(true,true));
$personList = new PersonList();
$personList->getAllPersons();
$conn->close();