<?php
$pageTitle = 'Книги от автор';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';
include 'includes' . DIRECTORY_SEPARATOR . 'constants.php';

if (isset($_GET['id'])) {
    $authorID = mysqli_real_escape_string($connection, trim($_GET['id']));

    if (!checkAuthorID($connection, $authorID)) {
        $query = 'SELECT books.book_id, books.book_title, authors.author_id, authors.author_name from books
                  LEFT JOIN books_authors ON books.book_id = books_authors.book_id
                  LEFT JOIN authors ON books_authors.author_id = authors.author_id
                  WHERE books.book_title IN
                  (SELECT book_title FROM books
                  LEFT JOIN books_authors ON books.book_id = books_authors.book_id
                  LEFT JOIN authors ON authors.author_id = books_authors.author_id
                  WHERE authors.author_id = ' . $authorID . ')';
        $query = sortBooks($query);
        $result = mysqli_query($connection, $query);

        if ($result) {
            $resultArray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultArray[$row['book_id']]['book_title'] = $row['book_title'];
                $resultArray[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
            }
        }
    }
    else {
        echo 'Несъществуващ автор!';
    }
}
else {
    header("Location: index.php");
    exit;
}

?>

    <div style="margin-bottom: 5px;">
        <a href="index.php">Книги</a>
    </div>

<?php
if (!checkAuthorID($connection, $authorID)) {
    include 'includes' . DIRECTORY_SEPARATOR . 'sort_form.php';
    include 'includes' . DIRECTORY_SEPARATOR . 'table_print.php';
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';