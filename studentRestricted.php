<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="js/generateTask.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Student</title>
</head>

<body onload="startPage()">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto navbar-left">
                    <li class="nav-item">
                        <a id= "navHome2" class="nav-link" href="index.php">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a id= "navText3" class="nav-link" href="restricted.php">Privátna zóna</a>
                    </li>
                    <li class="nav-item">
                        <a id= "navLogout" class="nav-link" href="logout.php">Odhlásiť sa</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" onclick="setLanguage('sk')">SK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="setLanguage('en')">EN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="studentArea">
    <div class="d-flex flex-column gap-2 align-items-center" id="generateTaskArea">
        <select id="selectGeneratedTask" class="form-control" style="width: 10vw"></select>
        <button id="generateTaskButton" class="btn btn-dark" type="button">Generate task</button>
    </div>
    <div class="row" id="completeTaskArea"></div>
    <div class="row" id="answerTaskArea">
        <div id="mathOutput" style="margin-bottom: 20px"></div>
        <input type="text" id="answerTaskInput" placeholder="Zadajte odpoveď" style="margin-bottom: 10px;" oninput="renderMath()">
        <div id="equationEditor" style="margin-bottom: 20px">
            <!-- <input type="text" id="mathInput" placeholder="Napíšte matematický vzorec" oninput="renderMath()" hidden> -->
            <button id="sqrtNormal" onclick="addOperation('sqrtN')">odmocnina</button>
            <button id="sqrtHigher" onclick="addOperation('sqrtH')">y-tá odmocnina</button>
            <button id="expHigher" onclick="addOperation('expH')">exponent</button>
            <button id="expLower" onclick="addOperation('expL')">dolný index</button>
            <button id="sum" onclick="addOperation('sum')">suma</button>
            <button id="sin" onclick="addOperation('sin')">sinus</button>
            <button id="cos" onclick="addOperation('cos')">kosínus</button>
            <button id="tan" onclick="addOperation('tan')">tangens</button>
            <button id="frac" onclick="addOperation('frac')">zlomok</button>
            <button id="lim" onclick="addOperation('lim')">limita</button>
            <button id="integral" onclick="addOperation('integral')">integrál</button>
        </div>
        <button id="sendAnsweredTaskButton" class="btn btn-success centered" type="button">Odoslať odpoveď</button>
    </div>
    <div class="row" id="studentTableArea"><?php require 'studentTable.php' ?></div>
</div>
<script>
    function setLanguage(language){
        var d = new Date();
        d.setTime(d.getTime() + (1 * 60 * 60 * 1000)); // Platnosť cookie - 1 hodina od aktuálneho času
        var expires = "expires=" + d.toUTCString();
        document.cookie = "language="+language+"; " + expires + "; path=/";
        changeStudent(language);
    }
    function startPage(){
        var language= getCookieValue();
        changeStudent(language);
    }
</script>
<script src="script.js"></script>
<script src="styleScript.js"></script>
</body>
</html>