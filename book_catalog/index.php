<?php
$pageTitle = 'Книжен каталог';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';
include 'includes' . DIRECTORY_SEPARATOR . 'constants.php';

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
}
else {
    echo 'Не мога да покажа данните в този момент!';
}
?>
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
            <th>Заглавие</th>
            <th>Автори</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($resultArray as $val) {
            echo '<tr><td>' . $val['book_title'] . '</td><td>';
            foreach ($val['authors'] as $key => $authorVal) {
                echo '<a href="' . $key . '">' . $authorVal . '</a> ';
            }
            echo '</td></tr>';
        }

        ?>
        </tbody>
    </table>

<?php
include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';