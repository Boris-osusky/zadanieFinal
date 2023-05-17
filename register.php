<?php
    session_start();

    require_once 'config.php';

    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

function checkEmpty($field)
{
    if (empty(trim($field))) {
        return true;
    }
    return false;
}

function checkLength($field, $min, $max)
{
    $string = trim($field);  
    $length = strlen($string); 
    if ($length < $min || $length > $max) {
        return false;
    }
    return true;
}

function checkUsername($username)
{
    if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))) {
        return false;
    }
    return true;
}

function checkFirstName($firstname) {
    if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
        return false;
    }   
    return true;
}

function checkLastName($lastname) {
    if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
        return false;
    }
    return true;
}


function checkGmail($email)
{
    if (!preg_match('/^[\w.+\-]+@gmail\.com$/', trim($email))) {
        return false;
    }
    return true;
}

function checkPasswordStrength($password) {
    if (!preg_match('/\d/', $password)) {
        return false;
    }
    
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    return true;
}

function userExist($db, $login, $email)
{
    $exist = false;

    $param_login = trim($login);
    $param_email = trim($email);

    $sql = "SELECT id FROM users WHERE login = :login OR email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":login", $param_login, PDO::PARAM_STR);
    $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $exist = true;
    }

    unset($stmt);

    return $exist;
}


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errmsg = "";

        if (checkEmpty($_POST['login']) === true) {
            $errmsg .= "<p>Zadajte login.</p>";
        } elseif (checkLength($_POST['login'], 6, 32) === false) {
            $errmsg .= "<p>Login musi mat min. 6 a max. 32 znakov.</p>";
        } elseif (checkUsername($_POST['login']) === false) {
            $errmsg .= "<p>Login moze obsahovat iba velke, male pismena, cislice a podtrznik.</p>";
        }
    
        if (userExist($pdo, $_POST['login'], $_POST['email']) === true) {
            $errmsg .= "Pouzivatel s tymto e-mailom / loginom uz existuje.</p>";
        }
    
        if (checkEmpty($_POST['password']) === true) {
            $errmsg .= "<p>Zadajte heslo.</p>";
        } elseif (checkLength($_POST['password'], 8, 32) === false) {
            $errmsg .= "<p>Heslo musi mat min. 8 a max. 32 znakov.</p>";
        } elseif (checkPasswordStrength($_POST['password']) === false) {
            $errmsg .= "<p>Heslo musi obsahovat aspon jedno cislo a jedno velke pismeno.</p>";
        }
    
        if (checkEmpty($_POST['firstname']) === true) {
            $errmsg .= "<p>Zadajte svoje meno.</p>";
        } elseif (checkLength($_POST['firstname'], 2, 64) === false) {
            $errmsg .= "<p>Meno musi mat min. 2 a max. 64 znakov.</p>";
        } elseif (checkFirstName($_POST['firstname']) === false) {
            $errmsg .= "<p>Meno musi obsahovat iba pismena.</p>";
        }
    
        if (checkEmpty($_POST['lastname']) === true) {
            $errmsg .= "<p>Zadajte svoje priezvisko.</p>";
        } elseif (checkLength($_POST['lastname'], 2, 64) === false) {
            $errmsg .= "<p>Priezvisko musi mat min. 2 a max. 64 znakov.</p>";
        } elseif (checkLastName($_POST['lastname']) === false) {
            $errmsg .= "<p>Priezvisko musi obsahovat iba pismena.</p>";
        }
    
        if (empty($errmsg)) {
            $sql = "INSERT INTO users (fullname, login, email, password, role) VALUES (:fullname, :login, :email, :password, :role)";
    
            $fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $hashed_password = password_hash($_POST['password'], PASSWORD_ARGON2ID);
    
            $stmt = $pdo->prepare($sql);

            $role = "student";
    
            $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(":role", $role, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $registered = true;
            }
            unset($stmt);
        }
        unset($pdo);
    }

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Register student</title>
</head>
<body>
    <main>
        <body>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="text-center">Registrácia</h1>
                                <h2 class="text-center">Vytvorenie nového konta studenta</h2>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                    <div class="form-group mb-3">
                                        <label for="firstname">Meno:</label>
                                        <input type="text" class="form-control" name="firstname" value="" id="firstname" placeholder="napr. Jozef" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="lastname">Priezvisko:</label>
                                        <input type="text" class="form-control" name="lastname" value="" id="lastname" placeholder="napr. Mrkvička" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">E-mail:</label>
                                        <input type="email" class="form-control" name="email" value="" id="email" placeholder="napr. jmrkvicka@example.com" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="login">Login:</label>
                                        <input type="text" class="form-control" name="login" value="" id="login" placeholder="napr. jcarrot" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Heslo:</label>
                                        <input type="password" class="form-control" name="password" value="" id="password" required>
                                    </div>

                                    <div class="form-group text-center mb-3">
                                        <button type="submit" class="btn btn-primary btn-block text-center">Vytvoriť konto</button>
                                    </div>

                                    <?php
                                    if (!empty($errmsg)) {
                                        echo '<div class="alert alert-danger">' . $errmsg . '</div>';
                                    }
                                    if (isset($registered)) {
                                        echo '<div class="container-md text-center"><p>Teraz sa mozte prihlasit: <a href="login.php" class="btn btn-primary" role="button">Login</a></p></div>';
                                    }
                                
                                    ?>

                                </form>
                                <p class="text-center">Mate vytvorene konto? <a href="login.php">Prihlaste sa tu.</a></p>
    </main>
    <script>
    const form = document.querySelector('form');
    const firstnameInput = document.getElementById('firstname');
    const firstnameError = document.getElementById('firstname-error');

    form.addEventListener('submit', function(event) {
        if (firstnameInput.value === '') {
            event.preventDefault();
            firstnameInput.classList.add('is-invalid');
            firstnameError.textContent = 'Prosím, vyplňte meno.';
        } else {
            firstnameInput.classList.remove('is-invalid');
            firstnameError.textContent = '';
        }
    });
</script>
</body>


</html>