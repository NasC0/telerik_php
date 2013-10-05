<?php
    $pageTitle = "Регистрирай се!";
    include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

    if(isset($_SESSION['isLogged'])) {
        echo '<p>Вече сте се логнали, ' . $_SESSION['username'] . '</p>';
    }
    else {
        if(isset($_POST['register'])) {
            $username = trim($_POST['username']);
            $pass = trim($_POST['pass']);
            $checkPass = trim($_POST['repeatPass']);
            $errorFlag = false;

            if(mb_strlen($username) <= 5 || mb_strlen($pass) <= 5) {
                echo 'Името или паролата не трябва да са по-къси от 5 символа!';
                $errorFlag = true;
            }
            elseif(mb_strlen($username) >= 20 || mb_strlen($pass) >= 20) {
                echo 'Името или паролата не трябва да са по-дълги от 20 символа!';
                $errorFlag = true;
            }
            if($pass != $checkPass) {
                echo 'Полетата за парола трябва да съвпадат!';
                $errorFlag = true;
            }
            if(checkUsername($connection, $username)) {
                echo 'Вече съществува потребител с това име!';
                $errorFlag = true;
            }

            if(!$errorFlag) {
                $query = "INSERT INTO users
                     (username, password, is_admin)
                     VALUES ('$username', '$pass', '0')";
                $result = mysqli_query($connection, $query);
                if($result) {
                    header('Location: index.php');
                    exit();
                }
                else {
                    echo mysqli_error($connection);
                }
            }
        }

        ?>
        <p>Регистрирай се: </p>
        <form method="POST" name="registerForm">
            <div>Име: <input type="text" name="username"></div>
            <div>Парола: <input type="password" name="pass"></div>
            <div>Повтори паролата: <input type="password" name="repeatPass"></div>
            <div><input type="submit" value="Регистрирай се" name="register"></div>
        </form>
        <?php
    }

    include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';