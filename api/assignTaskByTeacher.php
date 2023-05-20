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
$taskId = $_POST['selectedTask'];
$teacherId = $_POST['selectedTeacher'];
$message = [];

$query = "UPDATE tasks SET student_id = ?, used = 1 WHERE id = ? AND teacher_id = ?";

$statement = mysqli_prepare($connection, $query);

mysqli_stmt_bind_param($statement, "iii", $studentId, $taskId, $teacherId);

mysqli_stmt_execute($statement);

if (mysqli_stmt_affected_rows($statement) > 0) {
    $message = "Task updated successfully!";
} else {
    $message = "Failed to update task. Please check the provided values.";
}

mysqli_stmt_close($statement);
mysqli_close($connection);

echo $message;
?>
