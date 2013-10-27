<?php
require 'config.php';

function render($data, $layout)
{
    include $layout;
}

function getAuthors($connection)
{
    $q = mysqli_query($connection, 'SELECT * FROM authors');
    if (mysqli_error($connection)) {
        return false;
    }
    $ret = [];
    while ($row = mysqli_fetch_assoc($q)) {
        $ret[] = $row;
    }
    return $ret;
}

function isAuthorIdExists($connection, $ids)
{
    if (!is_array($ids)) {
        return false;
    }
    $q = mysqli_query($connection, 'SELECT * FROM authors WHERE
        author_id IN(' . implode(',', $ids) . ')');
    if (mysqli_error($connection)) {
        return false;
    }

    if (mysqli_num_rows($q) == count($ids)) {
        return true;
    }
    return false;
}