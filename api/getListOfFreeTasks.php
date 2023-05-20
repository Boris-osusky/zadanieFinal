<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';

$connection = mysqli_connect($hostname, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$studentId = $_POST['selectedValue'];

// Get the current date
$currentDate = date('Y-m-d');

$query = "SELECT t.id, t.teacher_id 
          FROM tasks t
          INNER JOIN files f ON t.files_id = f.id
          WHERE t.used != '1' 
          AND f.from_time < '$currentDate' 
          AND f.to_time > '$currentDate'";

$result = mysqli_query($connection, $query);

if ($result) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'id' => $row['id'],
            'teacher_id' => $row['teacher_id']
        );
    }
    $jsonData = json_encode($data);
    echo $jsonData;
} else {
    echo "Error retrieving tasks: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
