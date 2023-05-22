<?php
include_once('config.php');
session_start();

?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <title>WEBTECH 2</title>
</head>

<body>
<div class="container">
        <div id="equationEditor">
            <div id="mathOutput"></div>
            <input type="text" id="mathInput" placeholder="Napíšte matematický vzorec" oninput="renderMath()">
            <button id="sqrtNormal" onclick="addOperation('sqrtN')">\sqrt{x}</button>
            <button id="sqrtHigher" onclick="addOperation('sqrtH')">\sqrt[y]{x}</button>
            <button id="expHigher" onclick="addOperation('expH')">x^y</button>
            <button id="expLower" onclick="addOperation('expL')">x_y</button>
            <button id="sum" onclick="addOperation('sum')">\sum_{i=1}^n y</button>
            <button id="sin" onclick="addOperation('sin')">sin</button>
            <button id="cos" onclick="addOperation('cos')">cos</button>
            <button id="tan" onclick="addOperation('tan')">tan</button>
            <button id="frac" onclick="addOperation('frac')">fraction</button>
            <button id="square" onclick="addOperation('square')">[]</button>
            <button id="round" onclick="addOperation('round')">()</button>
        </div>
</div>
<script src="script.js"></script>
</body>

</html>