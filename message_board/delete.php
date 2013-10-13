<?php
include 'includes' . DIRECTORY_SEPARATOR . 'dbConfig.php';
session_start();

if (isset($_GET['msg'])) {
    if (isset($_SESSION['isLogged'])) {
        if ($_SESSION['isAdmin'] == false) {
            header('Location:messages.php');
            exit();
        }

        $msgID = $_GET['msg'];

        $query = "DELETE from messages
              WHERE msg_id = $msgID";
        $result = mysqli_query($connection, $query);

        if ($result) {
            header('Location:messages.php');
            exit();
        } else {
            echo 'Съобщението е изтрито неуспешно! ' . mysqli_error($connection);
        }
    } else {
        header('Location:index.php');
        exit();
    }
} else {
    header('Location:messages.php');
    exit();
}
