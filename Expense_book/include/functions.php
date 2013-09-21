<?php

date_default_timezone_set('UTC');

function dbConnect($server = "localhost", $user="root", $pass="", $db="expenses") {
    $connection = mysqli_connect($server, $user, $pass, $db) or trigger_error("Could not connect to database");
    return $connection;
}

function addExpense($date, $name, $price, $type) {
    $connection = dbConnect();

    if(strlen($name) <= 3) {
        trigger_error("Name must be bigger than 3 letters!");
    }
    elseif($price <= 0) {
        trigger_error("Price must be higher than 0!");
    }
    else {
        if(empty($date)) {
            $date = date('Y-m-d');
        }

        $sql = 'INSERT INTO records' .
                '(date, name, price, type)' .
                "VALUES ('$date', '$name', '$price', '$type')";

        mysqli_query($connection, $sql) or trigger_error("Could not enter data!") . mysqli_error($connection);

        echo "<div>Entered data succesfully!</div>";

        mysqli_close($connection);
    }
}

function tablePrint($type = "All", $date = null) {
    $connection = dbConnect();

    echo '<form method="get"><div id="List"><table style="border: 1px solid black"><thead><th><td>Изтрий</td><td>Дата</td><td>Име</td><td>Сума</td><td>Вид</td></th></thead>';
    echo '<tbody>';

    if($type == "All" && empty($date)) {
        $query = "SELECT * FROM records";
    }
    elseif($type == "All" && !empty($date)) {
        $query = "SELECT *
                  FROM records
                  WHERE date = DATE('$date')";
    }
    elseif($type !== "All" && empty($date)) {
        $query = "SELECT *
                  FROM records
                  WHERE type = '$type'";
    }
    else {
        $query = "SELECT *
                  FROM records
                  WHERE type = '$type'
                  AND date = DATE('$date')";
    }

    $result = mysqli_query($connection, $query);

    $sum = 0;

    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $id = $row[0];
        $date = $row[1];
        $name = $row[2];
        $price = $row[3];
        $type = $row[4];
        $sum += $price;

        echo "<tr><td></td><td><input type='radio' name='delete' value='$id'></td><td>$date</td><td>$name</td><td>$price</td><td>$type</td></tr>";
    }

    echo "<tr><td></td><td>--</td><td>--</td><td>$sum</td><td>--</td></tr>";
    echo "</tbody></table></div>
    <input type='submit' value='Изтрий' name='Delete'>
    </form>";

    mysqli_close($connection);
}

function deleteEntry($id) {
    $connection = dbConnect();

    $query = "DELETE
              FROM records
              WHERE id = '$id'";

    $result = mysqli_query($connection, $query) or trigger_error("Could not complete operation!") . mysqli_error($connection);

    mysqli_close($connection);
}

function editEntry($id, $date, $name, $price, $type) {
    $connection = dbConnect();

    if(strlen($name) <= 3) {
        trigger_error("Name must be bigger than 3 letters!");
    }
    elseif($price <= 0) {
        trigger_error("Price must be higher than 0!");
    }
    else {
        if(empty($date)) {
            $date = date('Y-m-d');
        }

        $sql = "UPDATE records
                SET date = (DATE)='$date', name='$name', price='$price', type='$type'
                WHERE id='$id'";

        $result = mysqli_query($connection, $sql) or trigger_error("Could not enter data!") . mysqli_error($connection);

        echo "<div>Entered data succesfully!</div>";

        mysqli_close($connection);
    }
}