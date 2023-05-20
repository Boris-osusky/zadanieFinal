<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6%22%3E"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js%22%3E"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/generateTask.js"></script>
    <title>Document</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Odhlasit sa</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>

<div class="container" id="studentArea">
    <div class="row" id="generateTaskArea">
        <select id="selectGeneratedTask" class="form-control"></select>
        <button id="generateTaskButton" class="btn btn-default" type="button">Generate task</button>
    </div>
    <div class="row" id="completeTaskArea"></div>
    <div class="row" id="answerTaskArea" hidden>
        <input type="text" id="answerTaskInput" placeholder="Type your answer">
        <button id="sendAnsweredTaskButton" class="btn btn-default" type="button">Send answer</button>
    </div>
    <div class="row" id="studentTableArea"><?php require 'studentTable.php' ?></div>
</div>
<div>

  \\(y=5\\)
</div>

</html>