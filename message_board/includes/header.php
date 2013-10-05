<?php
    session_start();
    error_reporting(E_ALL);
    mb_internal_encoding('UTF-8');

    include 'functions.php';
    include 'constants.php';
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
</head>
<body>

<?php
    if(isset($_SESSION['isLogged'])) {
        ?>
        <div>Здравей, <?= $_SESSION['username'] ?></div>
        <a href="messages.php">Разгледай всички съобщения</a> |
        <a href="new_message.php">Добави ново съобщение</a> |
        <a href="register.php">Регистрирай нов потребител</a> |
        <a href="logout.php">Изход</a>
        <?php
    }
    else {
        ?>
        <div>
            <a href="index.php">Вход</a> |
            <a href="register.php">Регистрирай нов потребител</a>
        </div>
        <?php
    }