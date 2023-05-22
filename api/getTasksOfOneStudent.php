<?php

session_start();
$studentID = $_SESSION['id']; //TODO - vybratie studenta zo session

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';

$connection = mysqli_connect($hostname, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT ID FROM tasks WHERE student_id = '$studentID'";
$result = mysqli_query($connection, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'value' => $row['ID'],
    );
}

$jsonData = json_encode($data);

mysqli_close($connection);

echo $jsonData;

?>