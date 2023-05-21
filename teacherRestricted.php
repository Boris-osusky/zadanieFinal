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
    <link rel="stylesheet" type="text/css" href="style.css">
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto navbar-left">
                    <li class="nav-item">
                        <a id= "navHome6" class="nav-link" href="index.php">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a id= "navText4" class="nav-link" href="restricted.php">Privátna zóna</a>
                    </li>
                    <li class="nav-item">
                        <a id= "navLogout2" class="nav-link" href="logout.php">Odhlásiť sa</a>
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

    <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-center form-group mb-3">
                    <div class="form-group text-left mb-3">
                        <label id= "teacherFrom" for="fromDateInput"><b>Od:</b></label>
                        <input type="date" id="fromDateInput">
                    </div>
                    <div class="form-group text-left mb-3">
                        <label id= "teacherTo" for="toDateInput"><b>Do:</b></label>
                        <input type="date" id="toDateInput">
                    </div>
                    <div class="form-group text-left mb-3">
                        <label id= "teacherPoints" for="pointsInput"><b>Body:</b></label>
                        <input type="text" id="pointsInput" placeholder="Enter points">
                    </div>
                </div>
                <div class="d-flex justify-content-center form-group mb-3">
                    <div id="dropzone">Drag and drop a file here to upload.</div>
                    <div id="progress"></div>
                </div>
                <div class="form-group text-center mb-3">
                    <div class="form-group text-center mb-3">
                        <label id= "teacherStudent" for="selectStudent"><b>Študent</b></label>
                        <select id="selectStudent"></select>
                    </div>
                    <div class="form-group text-center mb-3">
                        <label id= "teacherTask" for="selectTask"><b>Úloha</b></label>
                        <select id="selectTask"></select>
                    </div>
                </div>
                <div class="form-group text-center mb-3">
                    <button id="assignTaskButton" class="btn btn-dark mr-2">Assign task</button>
                </div>
            </div>
        </div>
        </div>
    </div>


    <!-- <div class= "row justify-content-center">
    <div class="col-md-6">
    <div class="form-group mb-3">
        <input type="text" id="pointsInput" placeholder="Enter points">
        <input type="date" id="fromDateInput">
        <input type="date" id="toDateInput">
    </div>
    <div class="form-group mb-3">
        <div id="dropzone">Drag and drop a file here to upload.</div>
        <div id="progress"></div>
    </div>
    <div class="form-group text-center mb-3">
        <select id="selectStudent"></select>
        <select id="selectTask"></select>
    </div>
    <div class="form-group text-center mb-3">
    <button id="assignTaskButton" class="btn btn-primary mr-2">Assign task</button>
    </div>
    </div>
    </div> -->
    <div id="teacherTableArea"><?php require 'tableInit.php'; ?></div>


<script src="styleScript.js"></script>
<script>
    function startPage(){
        var language= getCookieValue();
        changeTeacher(language);
    }

    function setLanguage(language){
        var d = new Date();
        d.setTime(d.getTime() + (1 * 60 * 60 * 1000)); // Platnosť cookie - 1 hodina od aktuálneho času
        var expires = "expires=" + d.toUTCString();
        document.cookie = "language="+language+"; " + expires + "; path=/";
        //document.cookie = "language="+language;
        changeTeacher(language);
    }
</script>
</body>
</html>