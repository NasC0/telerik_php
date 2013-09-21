<?php
    require_once 'include' . DIRECTORY_SEPARATOR . 'functions.php';
    if(isset($_GET['submit'])) {
        addExpense($_GET['date'], $_GET['name'], $_GET['price'], $_GET['type']);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Input form</title>
</head>
<body>
    <a href="index.php">List</a>
    <form method="get">
        <div><label for="name">Name: </label><input type="text" name="name" id="name"></div>
        <div><label for="price">Price: </label><input type="text" name="price" id="price"></div>
        <div><label for="date">Date: </label><input type="date" name="date" id="date"></div>
        <div>Type:
            <select name="type">
                <option value="Food">Food</option>
                <option value="Transport">Transport</option>
                <option value="Misc">Misc</option>
                <option value="Clothes">Clothes</option>
            </select>
        </div>
        <div><input type="submit" value="Submit" name="submit"></div>
    </form>
</body>
</html>