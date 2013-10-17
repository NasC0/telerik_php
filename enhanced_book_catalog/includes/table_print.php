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
            echo '<a href="authors_books.php?id=' . $key . '">' . $authorVal . '</a> ';
        }
        echo '</td></tr>';
    }

    ?>
    </tbody>
</table>