<?php
$pageTitle = "Добави Книга";
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_GET['submit'])) {

    $errorFlag = false;
    $bookTitle = mysqli_real_escape_string($connection, trim($_GET['bookTitle']));
    if (!isset($_GET['authors'])) {
        echo 'Трябва да изберете поне един автор за дадената книга!';
        $errorFlag = true;
    }

    $checkBook = checkBookTitle($connection, $bookTitle);
    if (!$checkBook && !$errorFlag) {
        $query = 'INSERT INTO books (book_title) VALUES ("' . $bookTitle . '")';
        $result = mysqli_query($connection, $query);
        if ($result) {

            $bookID = mysqli_insert_id($connection);
            $errorFlag = false;
            foreach ($_GET['authors'] as $authorID) {
                $query = 'INSERT INTO books_authors (book_id, author_id) VALUES ("' . $bookID . '", "' . $authorID . '")';
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    $errorFlag = true;
                    break;
                }
            }
            if (!$errorFlag) {
                echo 'Книгата е добавена успешно! <br>';
            }
        }
        else {
            echo 'Не успях да добавя книгата!';
        }

    }
    elseif ($checkBook && !$errorFlag) {
        echo 'Това заглавие вече съществува!';
    }

}
?>
    <form method="GET" name="addBook">
        <div>
            Заглавие: <input type="text" name="bookTitle">
        </div>
        <select name="authors[]" multiple style="margin-top: 5px; margin-bottom: 5px; height:150px;">
            <?php
            $query = "SELECT * FROM AUTHORS";
            $result = mysqli_query($connection, $query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?= $row['author_id'] ?>"><?= $row['author_name'] ?></option>
                <?php
                }
            }
            ?>
        </select>

        <div>
            <input type="submit" name="submit" value="Добави">
        </div>
    </form>

<?php
include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>