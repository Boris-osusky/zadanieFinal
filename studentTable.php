<?php
$studentId = 1;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = "localhost";
$username = "xosuskyb";
$password = "YWQVmLthAv3UEyV";
$dbname = "zFinal_users";

// Create a connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT points, submitted, correct_answer, tasks_id FROM generated_tasks WHERE student_id = $studentId";
$result = $conn->query($sql);

// Generate the HTML table
$tableHTML = '<table>
    <thead>
        <tr>
            <th>Your points</th>
            <th>Submitted</th>
            <th>Correct answer</th>
            <th>Task ID</th>
        </tr>
    </thead>
    <tbody>';

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $points = $row["points"];
        $submitted = $row["submitted"];
        $correctAnswer = $row["correct_answer"];
        $taskId = $row["tasks_id"];

        $submittedText = $submitted == 1 ? 'Submitted' : 'Not Submitted';
        $correctAnswerText = $correctAnswer == 1 ? 'Correct Answer' : 'Incorrect Answer';

        $tableHTML .= '<tr>
            <td>' . $points . '</td>
            <td>' . $submittedText . '</td>
            <td>' . $correctAnswerText . '</td>
            <td>Task ' . $taskId . '</td>
        </tr>';
    }
} else {
    $tableHTML .= '<tr><td colspan="4">No data available</td></tr>';
}

$tableHTML .= '</tbody></table>';

// Close the database connection
$conn->close();

echo $tableHTML;
?>