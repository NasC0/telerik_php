<table border="1px">
    <thead>
    <tr>
        <th>Заглавие</th>
        <th>Автори</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($resultArray as $key => $val) {
        echo '<tr><td><a href="books.php?bookID='. $key .'">' . $val['book_title'] . '</a></td><td>';
        foreach ($val['authors'] as $authorKey => $authorVal) {
            echo '<a href="authors_books.php?id=' . $authorKey . '">' . $authorVal . '</a> ';
        }
        echo '</td></tr>';
    }

    ?>
    </tbody>
</table>