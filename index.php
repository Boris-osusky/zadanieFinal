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
    <title>WEBTECH 2</title>
</head>

<body onload="startPage()">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto navbar-left">
                    <li class="nav-item">
                        <a id= "navHome1" class="nav-link" href="index.php">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a id= "navText" class="nav-link" href="restricted.php">Privátna zóna</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
                            if(isset($_COOKIE["language"])){
                                if($_COOKIE["language"]== "sk")
                                    echo '<a id= "navText" class="nav-link" href="restricted.php">Odhlásiť sa</a>';
                                else 
                                    echo '<a id= "navText" class="nav-link" href="restricted.php">Logout</a>';
                            }
                        ?>
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
    <h1 id= "indexIntro" class="text-center">Vitajte na stránke</h1>
</body>
<script>
    function startPage(){
        var language= getCookieValue();
        changeIndex(language);
    }

    function setLanguage(language){
        var d = new Date();
        d.setTime(d.getTime() + (1 * 60 * 60 * 1000)); // Platnosť cookie - 1 hodina od aktuálneho času
        var expires = "expires=" + d.toUTCString();
        document.cookie = "language="+language+"; " + expires + "; path=/";
        //document.cookie = "language="+language;
        changeIndex(language);
    }

</script>
<script src="styleScript.js"></script>
</html>