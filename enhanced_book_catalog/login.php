<?php
$pageTitle = "Вход";
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (!isset($_SESSION['isLogged'])) {
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($connection, trim($_POST['username']));
        $pass = mysqli_real_escape_string($connection, trim($_POST['pass']));
        $errorFlag = false;

        $query = 'SELECT * FROM users
             WHERE username = "' . $username . '"';
        $result = mysqli_query($connection, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($username == $row['username'] && $pass == $row['password']) {
                $_SESSION['isLogged'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $row['user_id'];

                header("Location:index.php");
                exit();
            }
        }
        echo 'Невалидно име или парола!';
    }

    ?>
    <form method="POST" name="loginForm">
        <div>Име: <input type="text" name="username"></div>
        <div>Парола: <input type="password" name="pass"></div>
        <div><input type="submit" name="login" value="Вход"></div>
    </form>
<?php
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';