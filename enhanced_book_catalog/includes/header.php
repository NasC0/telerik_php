<?php
mb_internal_encoding('utf8');
error_reporting(E_ALL);
mb_internal_encoding('UTF-8');
include 'functions.php';

if (isset($_POST['search'])) {
    $bookTitle = mysqli_real_escape_string($connection, trim($_POST['bookName']));
    header('Location: search.php?search=' . $bookTitle . '');
    exit;
}
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link href="css/blitzer/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
</head>
<body>

<form method="POST" name="searchBook" style="position:absolute; right: 5%;">
    Книга: <input type="text" name="bookName">
    <input type="submit" value="Търси" name="search">
</form>

</body>
</html>