<?php
//echo "LOGIN TU";

session_start();
require_once "config.php";

$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$sql = "SELECT fullname, id, email, login, password, role FROM users WHERE login = :login OR email = :email";


$stmt = $pdo->prepare($sql);

// Bind parameters for both login and email.
$stmt->bindParam(":login", $_POST["login"], PDO::PARAM_STR);
$stmt->bindParam(":email", $_POST["login"], PDO::PARAM_STR);

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $hashed_password = $row["password"];

            if (password_verify($_POST['password'], $hashed_password)) {
                // Save user data to session.
                $_SESSION["logged"] = true;
                $_SESSION["id"]= $row["id"];
                $_SESSION["login"] = $row['login'];
                $_SESSION["fullname"] = $row['fullname'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["created_at"] = $row['created_at'];
                $_SESSION["role"] = $row["role"];

                header("Location: restricted.php");
            } else {
                if(isset($_COOKIE["language"])){
                    if($_COOKIE["language"]== "sk")
                        $msg = "Nesprávne heslo.";
                    else 
                        $msg = "Incorrect password.";
                }    
            }
        } else if ($stmt->rowCount() == 0) {
            if(isset($_COOKIE["language"])){
                if($_COOKIE["language"]== "sk")
                    $msg = "Používateľ s týmto prihlasovacím menom alebo emailom neexistuje.";
                else 
                    $msg = "User with this username or email already exists.";
            }
        } else {
            if(isset($_COOKIE["language"])){
                if($_COOKIE["language"]== "sk")
                    $msg = "Niečo sa pokazilo. Skontaktujte administrátora.";
                else 
                    $msg = "Something went wrong. Contact the administrator.";
            }
        }
    } else {
        if(isset($_COOKIE["language"])){
            if($_COOKIE["language"]== "sk")
                $msg = "Niečo sa pokazilo. Skontaktujte administrátora.";
            else 
                $msg = "Something went wrong. Contact the administrator.";
        }
    }
}

unset($stmt);
unset($pdo);
?>

<!doctype html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body onload="startPage()">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto navbar-left">
                    <li class="nav-item">
                        <a id= "navHome5" class="nav-link" href="index.php">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a id= "navText2" class="nav-link" href="restricted.php">Privátna zóna</a>
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
                <div class="card-header">
                    <h3 id="loginH3" class="text-center">Prihlásenie</h3>
                </div>
                <div class="card-body">

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                        <div class="form-group mb-3">
                            <label id= "loginUser" for="login">Prihlasovacie meno:</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder="login/email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label id= "loginPass" for="password">Heslo:</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>

                        <?php
                        if (!empty($msg)) {
                            echo '<div class="alert alert-danger">' . $msg . '</div>';
                        }
                        ?>

                        <div class="form-group text-center mb-3">
                            <button id= "loginSubmit" type="submit" class="btn btn-dark mr-2">Prihlásiť sa</button>
                        </div>
                    </form>

                    <p id="loginP" class="text-center">Ešte nemáte vytvorené konto? <a href="register.php">Zaregistrujte sa.</a></p>

                </div>
            </div>

        </div>

    </div>

    </div>
    <script>
    function startPage(){
        var language= getCookieValue();
        console.log(language);
        changeLogin(language);
    }

    function setLanguage(language){
        var d = new Date();
        d.setTime(d.getTime() + (1 * 60 * 60 * 1000)); // Platnosť cookie - 1 hodina od aktuálneho času
        var expires = "expires=" + d.toUTCString();
        document.cookie = "language="+language+"; " + expires + "; path=/";
        console.log(language);
        changeLogin(language);
    }

</script>
<script src="styleScript.js"></script>
</body>
</html>