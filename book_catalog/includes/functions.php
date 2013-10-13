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

function sortAuthors($query) {
    $order = "";
    if(isset($_GET['sort'])) {
        switch($_GET['sortType']) {
            case "desc":
                $order = " ORDER BY author_name DESC";
                break;
            case "asc":
                $order = " ORDER BY author_name ASC";
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
    if (isset($_GET['sort'])) {
        switch ($_GET['sortType']) {
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