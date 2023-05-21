<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';
$uploadsDir = __DIR__ . '/../uploads/';

/////////////////////////////////////////init premennych
$filename = $_FILES['file']['name'];
$tmpFilePath = $_FILES['file']['tmp_name'];
$fileContents = file_get_contents($tmpFilePath);
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
$points = $_POST['points'];
session_start();
$userId = $_SESSION['id'];    //TODO - vybranie ID ucitela zo session
$parsed_tasks = [];
$filesId = [];

/////////////////////////////////////////zapis do DB tabuľky files
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $stmt = $conn->prepare("INSERT INTO files (file, from_time, to_time, points, users_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $fileContents, $fromDate, $toDate, $points, $userId);
    if ($stmt->execute()) {
        $filesId = $stmt->insert_id;
        $message = 'File insertion: Success (ID: ' . $filesId . ')';
    } else {
        $message = 'File insertion: Error executing query: ' . $stmt->error;
    }
    $stmt->close();
} else {
    $message = 'Error uploading file';
}
$conn->close();

/////////////////////////////////////////parsovanie
$file_contents = $fileContents;
$pattern = '/\\\\section\*{(.+?)}\s+\\\\begin{task}/s';

preg_match_all($pattern, $file_contents, $matches);

$ids = array();

foreach($matches[1] as $id){
    $ids[] = $id;
}

var_dump($ids);

$pattern = '/\\\\begin\{task\}(.*?)\\\\end\{task\}/s';
preg_match_all($pattern, $file_contents, $matches);
$equations = array();

foreach($matches[1] as $task_text){
    $eq_pattern = '/\$\$.+?\$\$|\\\\dfrac\{.+?\}\{.+?\}|\\\\begin\{equation\*\}(.*?)\\\\end\{equation\*\}/s';
    preg_match($eq_pattern, $task_text, $eq_matches);
    $equation = isset($eq_matches[0]) ? $eq_matches[0] : "";
    $task = preg_replace($eq_pattern, '', $task_text);
    $task = preg_replace('/\\\\includegraphics.*/s', '', $task);
    $equations[] = array("task" => trim($task), "equation" => $equation);
}

foreach($equations as $eq){
    $task = $eq['task'];
    $equation = $eq['equation'];
    $equation = preg_replace('/\\\\begin\{equation\*\}/', '', $equation);
    $equation = preg_replace('/\\\\end\{equation\*\}/', '', $equation);
    
    echo "Task: " . $task . "<br>";
    echo "Equation: " . $equation . "<br><br>"; 
}

$pattern = '/\\\\begin\{solution\}(.*?)\\\\end\{solution\}/s';

preg_match_all($pattern, $file_contents, $matches); 

$solutions = array();

foreach($matches[1] as $solution){
    $equation_pattern = '/\\\\begin\{equation\*\}(.*?)\\\\end\{equation\*\}/s';
    preg_match($equation_pattern, $solution, $eq_matches);
    $solutions[] = $eq_matches[1];
}

echo "<br>" . "solutions" . "<br>";

foreach($solutions as $solution){
    echo $solution . "<br>";
}

$pattern = '/\\\\begin\{task\}(.*?)\\\\end\{task\}/s';

preg_match_all($pattern, $file_contents, $matches); 

$paths = array();

foreach($matches[1] as $task){
    $graphics_pattern = '/\\\\includegraphics\{(.+?)\}/';
    preg_match($graphics_pattern, $task, $graphics_matches);
    if (isset($graphics_matches[1])) {
        $paths[] = $graphics_matches[1];
    } else {
        $paths[] = "nopath";
    }
}

foreach($equations as $index => $equation){
    //echo "Equation " . ($index + 1) . ": " . $equation . "<br>";
    echo "Image path: " . $paths[$index] . "<br>";
}

/////////////////////////////////////////zapis do DB tabuľky tasks
foreach ($ids as $index => $id) {
    $task = $equations[$index]['task'];
    $answer = $solutions[$index];
    $imagePath = $paths[$index];
    $image = file_get_contents("https://i.imgur.com/I86rTVl.jpeg");     //TODO
    $used = 0;
    $pointsPerTask = $points;

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = "INSERT INTO tasks (task, answer, image_path, image, used, points_per_task, teacher_id, files_id)
        VALUES (:task, :answer, :imagePath, :image, :used, :pointsPerTask, :teacherId, :filesId)";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':task', $task);
        $stmt->bindParam(':answer', $answer);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
        $stmt->bindParam(':used', $used);
        $stmt->bindParam(':pointsPerTask', $pointsPerTask);
        $stmt->bindParam(':teacherId', $userId);
        $stmt->bindParam(':filesId', $filesId);
        
        if ($stmt->execute()) {
            $message .= "\nTask insertion: New task inserted successfully!";
        } else {
            $message .= "\nTask insertion: Error inserting task: " . $stmt->errorInfo()[2];
        }
        
        $pdo = null;
    } catch (PDOException $e) {
        $message .= "\nDatabase Error: " . $e->getMessage();
    }
    
    echo $message;
} 
?>
