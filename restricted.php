<?php
    echo "HMMM";

    session_start();

    //require_once 'vendor/autoload.php';
    require_once 'config.php';

    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        exit;
      }

    if ($_SESSION['role'] == 'student') {
        header('Location: studentRestricted.php');
        exit;
    }

    if ($_SESSION['role'] == 'teacher') {
        header('Location: teacherRestricted.php');
        exit;
    }
?>