<?php
if(!isset($_SESSION)) {
    session_start();
}
$connection = mysqli_connect('localhost', 'root', '', 'books');
mysqli_set_charset($connection, 'utf8');
error_reporting(E_ALL);
mb_internal_encoding('UTF-8');
include 'functions.php';

if (isset($_POST['search'])) {
    $bookTitle = mysqli_real_escape_string($connection, trim($_POST['bookName']));
    header('Location: search.php?search=' . $bookTitle . '');
    exit;
}
if(isset($_SESSION['isLogged'])) {
    echo 'Здравей, '. $_SESSION['username'] .'! ';
    echo '<a href="logout.php">Изход</a>';
    echo ' | ';
    echo '<a href="index.php">Книги</a>';
}
else {
    echo '<a href="login.php">Вход</a>';
    echo ' | ';
    echo '<a href="register.php">Регистрирай се</a>';
    echo ' | ';
    echo '<a href="index.php">Книги</a>';
}
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link href="css/styles.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.js"></script>
</head>
<body>

<form method="POST" name="searchBook" style="float: right">
    Книга: <input type="text" name="bookName">
    <input type="submit" value="Търси" name="search">
</form>

</body>
</html>