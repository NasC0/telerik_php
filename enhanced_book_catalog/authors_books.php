<?php
$pageTitle = 'Книги от автор';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';
include 'includes' . DIRECTORY_SEPARATOR . 'jscript.php';
include 'includes' . DIRECTORY_SEPARATOR . 'constants.php';

$class = 'class="hideMe"';

if (isset($_GET['id'])) {
    $authorID = mysqli_real_escape_string($connection, trim($_GET['id']));

    if (!checkAuthorID($connection, $authorID)) {
        $query = 'SELECT books.book_id, books.book_title, books.msg_count, ba.author_id, authors.author_name FROM books
                  LEFT JOIN books_authors as ba ON books.book_id = ba.book_id
                  LEFT JOIN books_authors as bba ON ba.book_id = bba.book_id
                  LEFT JOIN authors ON ba.author_id = authors.author_id
                  WHERE bba.author_id = ' . $authorID;
        $query = sortBooks($query);
        $result = mysqli_query($connection, $query);

        if ($result) {
            $resultArray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultArray[$row['book_id']]['book_title'] = $row['book_title'];
                $resultArray[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
                $resultArray[$row['book_id']]['messageCount'] = $row['msg_count'];
            }
        }

        include 'includes' . DIRECTORY_SEPARATOR . 'sort_form.php';
        include 'includes' . DIRECTORY_SEPARATOR . 'print_books.php';
    }
    else {
        echo 'Несъществуващ автор!';
    }
}
else {
    header("Location: index.php");
    exit;
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';