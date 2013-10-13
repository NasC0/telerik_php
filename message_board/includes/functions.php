<?php
include 'dbConfig.php';

function checkUsername($connection, $username)
{
    $query = 'SELECT * FROM users WHERE username = "' . $username . '"';
    $result = mysqli_query($connection, $query);
    $rowNum = mysqli_num_rows($result);
    if ($rowNum > 0) {
        return true;
    } else {
        return false;
    }
}