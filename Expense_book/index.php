<?php
    require_once 'include' . DIRECTORY_SEPARATOR . 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense book</title>
</head>
<body>
    <a href="form.php">Add to list</a>

    <form method="get">
        <div>
            <select name="filter">
                <option value="All">All</option>
                <option value="Food">Food</option>
                <option value="Transport">Transport</option>
                <option value="Misc">Misc</option>
                <option value="Clothes">Clothes</option>
            </select>
            <label for="date">Дата: </label><input type="date" id="date" name="date">
            <input type="submit" value="Филтрирай" name="submit">
        </div>
    </form>

    <?php
        if(isset($_GET['submit'])) {
            tablePrint($_GET['filter'], $_GET['date']);

            if(isset($_GET['Delete'])) {
                $id = $_GET['delete'];

                deleteEntry($id);
            }
        }
        else {
            tablePrint();

            if(isset($_GET['Delete'])) {
                $id = $_GET['delete'];

                deleteEntry($id);
            }
        }
    ?>
</body>
</html>