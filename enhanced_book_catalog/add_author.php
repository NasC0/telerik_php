<?php

$pageTitle = "Добави Автор";
include 'includes' . DIRECTORY_SEPARATOR . 'constants.php';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_GET['submit'])) {
    $authorName = mysqli_real_escape_string($connection, trim($_GET['authorName']));

    if (!checkAuthorName($connection, $authorName)) {
        $query = 'INSERT INTO authors (author_name) VALUES ("' . $authorName . '")';
        if (mysqli_query($connection, $query)) {
            echo "Успешно добавен автор!";
        }
        else {
            echo "Неуспешно добавен автор!";
        }
    }
    else {
        echo 'Този автор вече съществува!';
    }
}
?>

    <form method="GET" name="addAuthor" style="margin-bottom: 5px;">
        <div>
            Автор: <input type="text" name="authorName">
            <input type="submit" name="submit" value="Добави">
        </div>
    </form>

<?php
include 'includes' . DIRECTORY_SEPARATOR . 'sort_form.php';
?>

    <table border="1px">
        <thead>
        <tr>
            <th>Автор</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = 'SELECT * FROM authors';
        $query = sortAuthors($query);
        $result = mysqli_query($connection, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $authorID = $row['author_id'];
                $authorName = $row['author_name'];
                ?>
                <tr>
                    <td><a href="authors_books.php?id=<?= $authorID ?>"><?= $authorName ?></a></td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>

<?php
include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>