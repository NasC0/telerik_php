<?php
$pageTitle = 'Търсене';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_GET['search'])) {
    $bookTitle = $_GET['search'];
    $query = 'SELECT book_id, book_title FROM books
              WHERE book_title = "' . $bookTitle . '"';
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        header('Location: books.php?bookID='. $row['book_id']);
        exit();
    }
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';