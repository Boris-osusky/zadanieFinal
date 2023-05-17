<?php
    session_start();

    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        exit;
      }
    
    if ($_SESSION['role'] == 'student' ) {
        header("Location: studentRestricted.php");
        exit;
    }
    echo "Vitaj ucitel";
?>