<?php

$pageTitle = "Добави Автор";
include 'includes' . DIRECTORY_SEPARATOR . 'constants.php';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if(isset($_GET['submit'])) {
    $authorName = mysqli_real_escape_string($connection, trim($_GET['authorName']));

    if(!checkAuthorName($connection, $authorName)) {
        $query = 'INSERT INTO authors (author_name) VALUES ("'. $authorName .'")';
        if(mysqli_query($connection, $query)) {
            echo "Успешно добавен автор!";
        }
        else {
            echo mysqli_error($connection);
        }
    }
}
?>

<form method="GET" name="addAuthor">
    <div>
        Автор: <input type="text" name="authorName"> <input type="submit" name="submit" value="Добави">
    </div>
</form>

<form method="GET" name="sortForm">
    <div>
        <select name="sortType">
            <?php
            foreach ($sortOptions as $key => $val) {
                $selected = '';
                if ($key == $_GET['sortType']) {
                    $selected = 'selected';
                }
                echo '<option value="' . $key . '"' . $selected . '>' . $val . '</option>';
            }

            ?>
        </select>
        <input type="submit" value="Сортирай" name="sort">
    </div>
</form>

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
        if($result){
            while($row = mysqli_fetch_assoc($result)) {
                $authorID = $row['author_id'];
                $authorName = $row['author_name'];
                ?>
                <tr>
                    <td><a href="<?= $authorID ?>"><?= $authorName ?></a></td>
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