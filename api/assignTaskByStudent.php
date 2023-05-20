<?php

$studentID = 1; //TODO - vybratie studenta zo session

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';

$selectedTask = $_POST['selectedTask'];
$connection = mysqli_connect($hostname, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT task, answer, image_path FROM tasks WHERE student_id = '$studentID' AND tasks.id = '$selectedTask'";
$result = mysqli_query($connection, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'task' => $row['task'],
        'answer' => $row['answer'],
        'image_path' => $row['image_path']
    );
}

$jsonData = json_encode($data);

mysqli_close($connection);

echo $jsonData;

?>