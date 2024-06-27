<?php
session_start();
require_once "db.php";

if (isset($_SESSION["users"])) {
    // Redirect based on user role
    $role = $_SESSION["users"]["role"];
    switch ($role) {
        case 'Sales Department':
            header("Location: index.php");
            break;
        case 'Production Department':
            header("Location: prodHome.php");
            break;
        case 'Buyer':
            header("Location: buyer.php");
            break;
    }
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL error");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["users"] = $user;
                // Redirect based on user role
                $role = $user["role"];
                switch ($role) {
                    case 'Sales Department':
                        header("Location: index.php");
                        break;
                    case 'Production Department':
                        header("Location: prodHome.php");
                        break;
                    case 'Buyer':
                        header("Location: buyer.php");
                        break;
                }
                exit();
            } else {
                $errors[] = "Username or password does not match";
            }
        }
    } elseif (isset($_POST["register"])) {
        $firstname = $_POST["first_name"];
        $lastname = $_POST["last_name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];
        $role = $_POST["role"];
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($passwordRepeat) || empty($role)) {
            $errors[] = "All fields are required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email is not valid";
        }
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
        if ($password !== $passwordRepeat) {
            $errors[] = "Password does not match";
        }
        
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL error");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                $errors[] = "Email already exists!";
            }
        }
        
        if (empty($errors)) {
            $sql = "INSERT INTO users (first_name, last_name, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $username, $email, $passwordHash, $role);
                mysqli_stmt_execute($stmt);
                $success = "You are registered successfully.";
            } else {
                die("Something went wrong");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Coca-Cola</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="box-login" id="login">
                <div class="top-header">
                    <h3>Welcome!</h3>
                    <small>We are happy to have you back.</small>
                </div>
                <div class="input-group">
                    <?php if (!empty($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <div class='alert alert-danger'><?= $error ?></div>
                        <?php endforeach; ?>
                    <?php elseif (isset($success)): ?>
                        <div class='alert alert-success'><?= $success ?></div>
                    <?php endif; ?>
                    <form action="logreg.php" method="post">
                        <div class="input-field">
                            <input type="text" class="input-box" name="username" id="logUser" required>
                            <label for="logUser">Username</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" name="password" id="logPassword" required>
                            <label for="logPassword">Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="togglePassword('logPassword', 'eye', 'eye-slash')">
                                    <i class="fa-regular fa-eye" id="eye"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash"></i>
                                </div>
                            </div>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="formCheck" class="check">
                            <label for="formCheck">Remember Me</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="input-submit" name="login" value="Sign In">
                        </div>
                        <div class="forgot">
                            <a href="#">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!---------------------------- register --------------------------------------->
            <div class="box-register" id="register">
                <div class="top-header">
                    <h3>Sign Up</h3>
                    <small>We are happy to have you with us.</small>
                </div>
                <div class="input-group">
                    <?php if (!empty($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <div class='alert alert-danger'><?= $error ?></div>
                        <?php endforeach; ?>
                    <?php elseif (isset($success)): ?>
                        <div class='alert alert-success'><?= $success ?></div>
                    <?php endif; ?>
                    <form action="logreg.php" method="post">
                        <div class="input-field">
                            <input type="text" class="input-box" name="first_name" id="regFirstname" required>
                            <label for="regFirstname">First Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" name="last_name" id="regLastname" required>
                            <label for="regLastname">Last Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" name="username" id="regUsername" required>
                            <label for="regUsername">Username</label>
                        </div>
                        <div class="input-field">
                            <input type="email" class="input-box" name="email" id="regEmail" required>
                            <label for="regEmail">Email address</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" name="password" id="regPassword" required>
                            <label for="regPassword">Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="togglePassword('regPassword', 'eye-2', 'eye-slash-2')">
                                    <i class="fa-regular fa-eye" id="eye-2"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" name="repeat_password" id="regPasswordRepeat" required>
                            <label for="regPasswordRepeat">Repeat Password</label>
                        </div>
                        <div class="input-field">
                            <select name="role" class="input-box" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="Sales Department">Sales Department</option>
                                <option value="Production Department">Production Department</option>
                                <option value="Buyer">Buyer</option>
                            </select>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="formCheck2" class="check">
                            <label for="formCheck2">Remember Me</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="input-submit" name="register" value="Sign Up">
                        </div>
                    </form>
                </div>
            </div>
            <div class="switch">
                <a href="#" class="login active" onclick="toggleForm('login')">Login</a>
                <a href="#" class="register" onclick="toggleForm('register')">Register</a>
                <div class="btn-active" id="btn"></div>
            </div>
        </div>
    </div>
    <script>
        function toggleForm(form) {
            var login = document.getElementById('login');
            var register = document.getElementById('register');
            var btn = document.getElementById('btn');

            if (form === 'login') {
                login.style.left = "27px";
                register.style.right = "-350px";
                btn.style.left = "0px";
            } else {
                login.style.left = "-350px";
                register.style.right = "25px";
                btn.style.left = "150px";
            }
        }

        function togglePassword(inputId, eyeId, eyeSlashId) {
            var input = document.getElementById(inputId);
            var eye = document.getElementById(eyeId);
            var eyeSlash = document.getElementById(eyeSlashId);

            if (input.type === "password") {
                input.type = "text";
                eye.style.opacity = "0";
                eyeSlash.style.opacity = "1";
            } else {
                input.type = "password";
                eye.style.opacity = "1";
                eyeSlash.style.opacity = "0";
            }
        }
    </script>
</body>
</html>
