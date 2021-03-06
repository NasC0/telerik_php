<?php
$pageTitle = 'Търсене';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_GET['search'])) {
    $bookTitle = $_GET['search'];
    $query = 'SELECT books.book_id, books.book_title, authors.author_id, authors.author_name FROM books
              LEFT JOIN books_authors ON books.book_id = books_authors.book_id
              LEFT JOIN authors ON books_authors.author_id = authors.author_id
              WHERE books.book_title = "' . $bookTitle . '"';
    $result = mysqli_query($connection, $query);

    $resultArray = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bookID = $row['book_id'];
            $resultArray[$row['book_id']]['book_title'] = $row['book_title'];
            $resultArray[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
        }
    }
}
?>

    <div style="margin-bottom: 5px;">
        <a href="index.php">Книги</a>
    </div>

<?php
if(mysqli_num_rows($result) > 0) {
    ?>
        <ul id="nav">
            <li class="wrap">
                <span><?= $resultArray[$bookID]['book_title'] ?></span>
                <ul>
                    <li>
                        <div>Автори:</div>
                        <div class="innerWrap">
                            <?php
                            foreach ($resultArray[$bookID]['authors'] as $keyAuthor => $valAuthor) {
                                ?>
                                <a href="authors_books.php?id=<?= $keyAuthor ?>"><?= $valAuthor ?></a>
                            <?php
                            }

                            ?>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    <?php
}
else {
    echo 'Няма намерени резултати за тази книга!';
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';