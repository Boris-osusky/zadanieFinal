<?php
require_once 'config.php';

$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$sql = "SELECT fullname, id FROM users WHERE role = 'student'";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$userList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="teacherTableArea">
    <div class="container" id="tableContentArea">
        <table id="studentTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>ID</th>
                    <!--<th>Pocet gen. uloh</th>-->
                    <th>Pocet vyriesenych uloh</th>
                    <th>Body spolu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userList as $user) {
                    $studentId = $user['id'];

                    $sqlGenerated = "SELECT COUNT(*) FROM generated_tasks WHERE student_id = :id";
                    $stmtGenerated = $pdo->prepare($sqlGenerated);
                    $stmtGenerated->bindParam(":id", $studentId);
                    $stmtGenerated->execute();
                    $generatedCount = $stmtGenerated->fetchColumn();

                    $sqlSubmitted = "SELECT COUNT(*) FROM generated_tasks WHERE student_id = :id AND submitted = 1";
                    $stmtSubmitted = $pdo->prepare($sqlSubmitted);
                    $stmtSubmitted->bindParam(":id", $studentId);
                    $stmtSubmitted->execute();
                    $submittedCount = $stmtSubmitted->fetchColumn();

                    $sqlPoints = "SELECT SUM(points) AS totalPoints FROM generated_tasks WHERE student_id = :id";
                    $stmtPoints = $pdo->prepare($sqlPoints);
                    $stmtPoints->bindParam(":id", $studentId);
                    $stmtPoints->execute();
                    $resultPoints = $stmtPoints->fetch(PDO::FETCH_ASSOC);
                    $totalPoints = $resultPoints['totalPoints'];

                    if (empty($resultPoints['totalPoints'])) {
                        $totalPoints = 0;
                    }
                    ?>

                    <tr>
                        <td><?php echo $user['fullname']; ?></td>
                        <td><?php echo $user['id']; ?></td>
                        <!--<td><?php echo $generatedCount; ?></td>-->
                        <td><?php echo $submittedCount; ?></td>
                        <td><?php echo $totalPoints; ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
