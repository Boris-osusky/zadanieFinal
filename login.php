<?php
echo "LOGIN TU";

session_start();
require_once "config.php";

$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$sql = "SELECT fullname, email, login, password, role FROM users WHERE login = :login OR email = :email";


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
                $_SESSION["login"] = $row['login'];
                $_SESSION["fullname"] = $row['fullname'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["created_at"] = $row['created_at'];
                $_SESSION["role"] = $row["role"];

                header("Location: restricted.php");
            } else {
                $msg = "Nesprávne heslo.";
            }
        } else if ($stmt->rowCount() == 0) {
            $msg = "Používateľ s týmto prihlasovacím menom alebo emailom neexistuje.";
        } else {
            $msg  = "Niečo sa pokazilo. Skontaktujte administrátora.";
        }
    } else {
        $msg = "Niečo sa pokazilo. Skontaktujte administrátora.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="text-center">Prihlásenie</h3>
                </div>
                <div class="card-body">

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                        <div class="form-group mb-3">
                            <label for="login">Prihlasovacie meno:</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder="login/email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Heslo:</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>

                        <?php
                        if (!empty($msg)) {
                            echo '<div class="alert alert-danger">' . $msg . '</div>';
                        }
                        ?>

                        <div class="form-group text-center mb-3">
                            <button type="submit" class="btn btn-primary mr-2">Prihlásiť sa</button>
                        </div>
                    </form>

                    <p class="text-center">Ešte nemáte vytvorené konto? <a href="register.php">Zaregistrujte sa.</a></p>

                </div>
            </div>

        </div>

    </div>

    </div>
</body>

</html>