<?php
include 'dbConfig.php';
mb_internal_encoding('utf8');

function checkAuthorName($connection, $authorName)
{
    $result = false;
    if (mb_strlen($authorName) < 3) {
        echo "Името на автора не трябва да е по-късо от 3 символа!";
        return true;
    }
    $query = 'SELECT author_name from authors WHERE author_name = "' . $authorName . '"';
    $queryResult = mysqli_query($connection, $query);
    if (mysqli_num_rows($queryResult) > 0) {
        $result = true;
    }
    return $result;
}

function checkAuthorID($connection, $authorID)
{
    $result = false;
    $query = 'SELECT author_id from authors WHERE author_id = "' . $authorID . '"';
    $queryResult = mysqli_query($connection, $query);
    if (mysqli_num_rows($queryResult) == 0) {
        $result = true;
    }
    return $result;
}

function checkBookTitle($connection, $bookTitle)
{
    $result = false;
    if (mb_strlen($bookTitle) < 3) {
        echo "Заглавието на книгата не трябва да е по-късо от 3 символа!";
        return true;
    }
    $query = 'SELECT book_title from books WHERE book_title = "' . $bookTitle . '"';
    $queryResult = mysqli_query($connection, $query);
    if (mysqli_num_rows($queryResult) > 0) {
        $result = true;
    }
    return $result;
}

function checkUsername($connection, $username)
{
    $query = 'SELECT * FROM users WHERE username = "' . $username . '"';
    $result = mysqli_query($connection, $query);
    $rowNum = mysqli_num_rows($result);
    if ($rowNum > 0) {
        return true;
    }
    else {
        return false;
    }
}

function sortAuthors($query)
{
    $order = "";
    if (isset($_POST['sort'])) {
        switch ($_POST['sortType']) {
            case "desc":
                $order = " ORDER BY authors.author_name DESC";
                break;
            case "asc":
                $order = " ORDER BY authors.author_name ASC";
                break;
            default:
                $order = "";
                break;
        }
    }
    $query .= $order;
    return $query;
}

function sortBooks($query)
{
    $order = "";
    if (isset($_POST['sort'])) {
        switch ($_POST['sortType']) {
            case "desc":
                $order = " ORDER BY books.book_title DESC";
                break;
            case "asc":
                $order = " ORDER BY books.book_title ASC";
                break;
            default:
                $order = "";
                break;
        }
    }
    $query .= $order;
    return $query;
}