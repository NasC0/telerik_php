<?php
$pageTitle = "Регистрирай се";
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($connection, trim($_POST['username']));
    $pass = mysqli_real_escape_string($connection, trim($_POST['pass']));
    $errorFlag = false;

    if (mb_strlen($username) < 3 || mb_strlen($pass) < 3) {
        echo 'Името и паролата трябва да са дълги поне 3 символа!';
        $errorFlag = true;
    }

    if (checkUsername($connection, $username)) {
        echo 'Вече съществува потребител с това име!';
        $errorFlag = true;
    }

    if(!$errorFlag) {
        $query = 'INSERT INTO users
                 (username, password)
                 VALUES("'. $username .'", "'. $pass .'")';
        $result = mysqli_query($connection, $query);
        if($result) {
            echo 'Регистрацията е успешна!';
        }
        else {
            echo 'Имаше проблем при регистрацията!';
        }
    }
}
?>

<form method="POST" name="registerForm">
    <div>Име: <input type="text" name="username"></div>
    <div>Парола: <input type="password" name="pass"></div>
    <div><input type="submit" name="register" value="Регистрирай се"></div>
</form>

<?php
include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';