<?php

    require_once '../config.php';

    $data = $_POST['input'];
    $taskId = $_POST['selectedTask'];   //id (PK) in tasks
    $message = '';

    $dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $taskQuery = $pdo->prepare("SELECT t.*, g.submitted 
        FROM tasks t 
        LEFT JOIN generated_tasks g ON t.id = g.tasks_id 
        WHERE t.id = :taskId AND (g.submitted IS NULL OR g.submitted = 0)");

        $taskQuery->bindValue(':taskId', $taskId);
        $taskQuery->execute();
        $task = $taskQuery->fetch(PDO::FETCH_ASSOC);

        if ($task) {
            if (!strcasecmp(trim($data), trim($task['answer'])))   {
                $insertQuery = $pdo->prepare("INSERT INTO generated_tasks (points, submitted, correct_answer, student_id, tasks_id)
                    VALUES (:points, 1, 1, :studentId, :taskId)");
                $insertQuery->bindValue(':points', $task['points_per_task']);
                $insertQuery->bindValue(':studentId', $task['student_id']);
                $insertQuery->bindValue(':taskId', $taskId);
                $insertQuery->execute();
                $message = 'Answer is correct.';
            } else {
                $insertQuery = $pdo->prepare("INSERT INTO generated_tasks (points, submitted, correct_answer, student_id, tasks_id)
                    VALUES (:points, 1, 0, :studentId, :taskId)");
                $insertQuery->bindValue(':points', $task['points_per_task']);
                $insertQuery->bindValue(':studentId', $task['student_id']);
                $insertQuery->bindValue(':taskId', $taskId);
                $insertQuery->execute();
                $message = 'Incorrect answer.';
            }
        } else {
            $message = 'Task was already answered.';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    echo json_encode($message);
?>
