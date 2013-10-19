<?php
$pageTitle = 'Книжен каталог';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';
include 'includes' . DIRECTORY_SEPARATOR . 'jscript.php';
include 'includes' . DIRECTORY_SEPARATOR . 'constants.php';

$class = 'class="hideMe"';

$query = 'SELECT books.book_id, books.book_title, authors.author_id, authors.author_name from books
          LEFT JOIN books_authors on books.book_id = books_authors.book_id
          LEFT JOIN authors on books_authors.author_id = authors.author_id';

$query = sortBooks($query);

$resultArray = array();
$result = mysqli_query($connection, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $resultArray[$row['book_id']]['book_title'] = $row['book_title'];
        $resultArray[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
    }

    foreach ($resultArray as $key => $val) {
        $query = 'SELECT * FROM books_messages
                      WHERE book_id ='. $key .'';
        $result = mysqli_query($connection, $query);
        $resultArray[$key]['messageCount'] = mysqli_num_rows($result);
    }
}
else {
    echo 'Не мога да покажа данните в този момент!';
}
?>
    <div style="margin-bottom: 5px;">
        <a href="add_book.php">Добави Книга</a>
        <a href="add_author.php">Добави Автор</a>
    </div>

<?php
include 'includes' . DIRECTORY_SEPARATOR . 'sort_form.php';

include 'includes' . DIRECTORY_SEPARATOR . 'print_books.php';

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';