<?php
$pageTitle = 'Книги от автор';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';
include 'includes' . DIRECTORY_SEPARATOR . 'jscript.php';
include 'includes' . DIRECTORY_SEPARATOR . 'constants.php';

$class = 'class="hideMe"';

if (isset($_GET['id'])) {
    $authorID = mysqli_real_escape_string($connection, trim($_GET['id']));

    if (!checkAuthorID($connection, $authorID)) {
        $query = 'SELECT b.book_id, b.book_title, ba.author_id, a.author_name FROM books as b
                  LEFT JOIN books_authors as ba ON b.book_id = ba.book_id
                  LEFT JOIN books_authors as bba ON ba.book_id = bba.book_id
                  LEFT JOIN authors as a ON ba.author_id = a.author_id
                  WHERE bba.author_id = '. $authorID;
        $query = sortBooks($query);
        $result = mysqli_query($connection, $query);

        if ($result) {
            $resultArray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultArray[$row['book_id']]['book_title'] = $row['book_title'];
                $resultArray[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
            }
        }

        foreach ($resultArray as $key => $val) {
            $query = 'SELECT * FROM books_messages
                      WHERE book_id =' . $key . '';
            $result = mysqli_query($connection, $query);
            $resultArray[$key]['messageCount'] = mysqli_num_rows($result);
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