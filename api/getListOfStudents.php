<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';

$connection = mysqli_connect($hostname, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT ID, fullname FROM users WHERE role = 'student'";
$result = mysqli_query($connection, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'value' => $row['ID'],
        'text' => $row['fullname']
    );
}

$jsonData = json_encode($data);

mysqli_close($connection);

echo $jsonData;


?>