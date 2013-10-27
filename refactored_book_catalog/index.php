<?php
include 'inc' . DIRECTORY_SEPARATOR . 'config.php';
include 'inc' . DIRECTORY_SEPARATOR . 'functions.php';
$data = [];
$data['title'] = 'Списък';

if (isset($_GET['author_id'])) {
    $author_id = (int)$_GET['author_id'];
    $query = 'SELECT books.book_id, books.book_title, authors.author_name, bba.author_id FROM books
    LEFT JOIN books_authors as ba ON books.book_id = ba.book_id
    LEFT JOIN books_authors as bba ON ba.book_id = bba.book_id
    LEFT JOIN authors ON bba.author_id = authors.author_id
    WHERE ba.author_id = '. $author_id;
    $q = mysqli_query($connection, $query);
}
else {
    $query = 'SELECT * FROM books as b INNER JOIN
    books_authors as ba ON b.book_id=ba.book_id INNER JOIN authors as a
     ON a.author_id=ba.author_id';
    $q = mysqli_query($connection, $query);
}

while ($row = mysqli_fetch_assoc($q)) {
    $data['books'][$row['book_id']]['book_title'] = $row['book_title'];
    $data['books'][$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
}
$data['content'] = './templates/index_template.php';
render($data, 'templates' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'default_layout.php');