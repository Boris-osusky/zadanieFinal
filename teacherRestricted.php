<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <title>Teacher page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/dragNdrop.js"></script>
    <script src="js/assignTaskByTeacher.js"></script>
    <style>
        #dropzone {
            width: 300px;
            height: 200px;
            border: 2px dashed #ccc;
            text-align: center;
            padding: 50px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            </div>
        </div>
    </nav>

    <input type="text" id="pointsInput" placeholder="Enter points">
    <input type="date" id="fromDateInput">
    <input type="date" id="toDateInput">
    <div id="dropzone">Drag and drop a file here to upload.</div>
    <div id="progress"></div>
    <select id="selectStudent"></select>
    <select id="selectTask"></select>
    <button id="assignTaskButton">Assign task</button>
    <div id="teacherTableArea"><?php require 'tableInit.php'; ?></div>
</body>

</html>