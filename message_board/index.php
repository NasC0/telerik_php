<?php
    $pageTitle = "Вход";
    include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

    if(!isset($_SESSION['isLogged'])) {
        if(isset($_POST['login'])) {
            $username = trim($_POST['username']);
            $pass = trim($_POST['pass']);

            $query = "SELECT * FROM users";
            $result = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($result)) {

                if($username == $row['username'] && $pass == $row['password']) {
                    $_SESSION['userId'] = (int) $row['user_id'];
                    $_SESSION['isLogged'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['isAdmin'] = false;

                    if((int) $row['is_admin'] == 1) {
                        $_SESSION['isAdmin'] = true;
                    }

                    header('Location:messages.php');
                    exit();
                }
            }
            echo 'Грешно име и/или парола!';
        }
        ?>
        <p>Вход: </p>
        <form method="POST"  name="loginForm">
        <div>Име: <input type="text" name="username"></div>
        <div>Парола: <input type="password" name="pass"></div>
        <div><input type="submit" value="Вход" name="login"></div>
        </form>
        <?php
    }
    include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>

